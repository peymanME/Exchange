<?php
namespace Exchange\Services;

use Exchange\Services\Base\ServiceBase;
use Exchange\Services\Abstracts\Interfaces\CurrencyServiceInterface;
use Exchange\Models\Entities\Wallet;
use Exchange\Models\Entities\CurrenciesName;



class CurrencyService extends ServiceBase implements CurrencyServiceInterface 
{
    protected $walletService;
    protected $userService;


    public function __construct($entityManager, $authenticationService) {
        parent::__construct($entityManager);
        $this->walletService=new WalletService($entityManager, $authenticationService);
        $this->userService = new UserService($entityManager, $authenticationService);
    
    }
    
    public function addToWalet ($entityArray){
        $wallet= new Wallet();
        $user = $this->userService->getUserObj();
        $this->addToMyCurrency ($entityArray['CurrenciesName'],$user);
        $wallet->setUsers($user);
        $wallet->setid($user->getid());
        $wallet->setCash((int)$entityArray['Money']);     
        $this->save($wallet);   
   }

    public function getCurrencyByCode($code){
        $array = array("Code" => $code);
        $currency = $this->findBy(CurrenciesName::class, $array);
        if (count($currency) !== 0 ){
            return $currency[0];
        }
        return null;
        
    }
    
    private function addToMyCurrency ($currencyArray, $user){
        foreach ($currencyArray as $currency){
            $currency = $this->find(CurrenciesName::class, (int)$currency);
            if ( !$user->getCurrencies()->contains($currency) ) {
                $user->addCurrencies($currency);
            }
        }
    }
}