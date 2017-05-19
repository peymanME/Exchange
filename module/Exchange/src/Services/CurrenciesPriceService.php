<?php
namespace Exchange\Services;

use Exchange\Services\Base\ServiceBase;
use Exchange\Services\Abstracts\Interfaces\CurrenciesPriceServiceInterface;
use Exchange\Models\Entities\CurrenciesPrice;
use Exchange\Services\CurrencyService;
use Zend\Session\Container;



class CurrenciesPriceService extends ServiceBase implements CurrenciesPriceServiceInterface 
{
    protected $currencyService;
    
    public function __construct($entityManager, $authenticationService) {
        parent::__construct($entityManager);
        
        $this->currencyService = new CurrencyService($entityManager, $authenticationService);
    }
    
    public function getJsonData(){
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "http://webtask.future-processing.com:8068/currencies");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch); 
        return $output;
    }
    
    public function recordCurrencies($json){ 
        $exchange = json_decode($json);
        if (is_null($exchange)){
            throw new \Exception("Server is disconnected");
        }
        $currenciesAtMoment = []; 
        foreach($exchange->items as $item){
            $currenciesPrice = $this->setToObject($item, $exchange->publicationDate);
            $this->saveOnSession($currenciesPrice);
            array_push($currenciesAtMoment, $currenciesPrice);
        }
        return $currenciesAtMoment;
    }
    private function setToObject($item, $date){       
        $currenciesPrice = new CurrenciesPrice();
        $currenciesPrice->setAveragePrice($item->averagePrice);
        $currenciesPrice->setDateRegister(new \DateTime($date));
        $currenciesPrice->setSellPrice($item->sellPrice);
        $currenciesPrice->setPurchasePrice($item->purchasePrice);
        $currenciesPrice->setUnit($item->unit);
        $currenciesPrice->setCurrenciesName($this->currencyService->getCurrencyByCode($item->code));
        return $currenciesPrice;
    }
    
    private function saveOnSession($currenciesPrice){
        $sessionCurrency = new Container ( $currenciesPrice->getCurrenciesName()->getCode() );
        $sessionCurrency->SellPrice     = $currenciesPrice->getSellPrice ();
        $sessionCurrency->Unit          = $currenciesPrice->getUnit ();
        $sessionCurrency->PurchasePrice = $currenciesPrice->getPurchasePrice();
        $sessionCurrency->AveragePrice  = $currenciesPrice->getAveragePrice();

    }

    public function sessionToObject($key){
        $currenciesPrice = new CurrenciesPrice();
        $sessionCurrency = new Container ( $key );
        $currenciesPrice->setSellPrice ($sessionCurrency->SellPrice);
        $currenciesPrice->setUnit ($sessionCurrency->Unit);
        $currenciesPrice->setPurchasePrice($sessionCurrency->PurchasePrice);
        $currenciesPrice->setAveragePrice($sessionCurrency->AveragePrice );
        $currenciesPrice->setCurrenciesName($this->currencyService->getCurrencyByCode($key));
        return $currenciesPrice;
   }
   
   public function getUserCurrencies($myCurrencies, $currencies){
       $myCurr = [];
       foreach ($currencies as $currency){
           if ( $myCurrencies->contains($currency->getCurrenciesName()) ) {
                array_push($myCurr, $currency);
            }
       }
       return $myCurr;
   }
}