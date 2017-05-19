<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Exchange\Controller;

use Exchange\Controller\Base\ControllerBase;
use Exchange\Models\ViewModels\ExchangeViewModel;
use Exchange\Services\WalletService;
use Exchange\Models\ViewModels\CurrenciesViewModel;
use Exchange\Services\CurrenciesPriceService;
use Exchange\Services\UserService;

class ExchangeController extends ControllerBase
{
    protected $walletService;
    protected $currenciesPriceService;
    protected $userService;
    
    function __construct($entityManager, $authenticationService) {
        parent::__construct($entityManager, $authenticationService);
        
        $this->walletService = new WalletService($entityManager, $authenticationService);
        $this->currenciesPriceService = new CurrenciesPriceService($entityManager, $authenticationService);
        $this->userService = new UserService($entityManager, $authenticationService);
        
    }

    public function indexAction(){        
       $this->getLogs();
        if ($this->userService->is_Authenticate()) {
            $exchangeViewModel  = new ExchangeViewModel();
 
            $user = $this->userService->getUserObj();//$this->userService->getUserBySession();
                        
            if ($user!== null){
                try{
                    $currencies = $this->getExchangeData();
                    if (is_null($currencies->getListOf())){
                        $this->exceptionService->Invoke_Throw("Server is disconected");
                    }
                    $cash = (!is_null($user->getWallet()))? $user->getWallet()->getCash():0;
                    $exchangeViewModel->setCash($cash );
                    $exchangeViewModel->setCurrenciesViewModel($currencies);
                    $exchangeViewModel->setListOf($this->getMyCurrencies($user->getCurrencies(), $currencies->getListOf()));                  
                } catch (\Exception $ex) {
                    $exchangeViewModel->setErrorMessage($ex->getMessage());
                }
            }            
            return $this->viewModel(array ('exchangeViewModel'=>$exchangeViewModel));
        }
        return $this->goToLogin();
    }
    
    protected function getExchangeData(){
        try {
            $currenciesViewModel  = new CurrenciesViewModel();        
            $exchanges = $this->recordCurrencies($this->getJsonData());
            if (is_null($exchanges)){
                $this->exceptionService->Invoke_Throw("Server is disconected");
            }
            $currenciesViewModel->setListOf($exchanges);            
        } catch ( \Exception $ex) {
            $currenciesViewModel->setErrorMessage($ex->getMessage()); 
            $currenciesViewModel->setListOf(null);
        }
        return $currenciesViewModel;
    }
    
     protected function getJsonData(){
       return $this->currenciesPriceService->getJsonData();
    }
    
    protected function recordCurrencies($json){
        return $this->currenciesPriceService->recordCurrencies($json);
    }
    
    protected function getMyCurrencies($myCurrencies, $currencies){
        return $this->currenciesPriceService->getUserCurrencies($myCurrencies, $currencies);
    }
    
    public function exchangeAction(){
        $this->getLogs();
        if ($this->userService->is_Authenticate()) {
            return $this->jsonModel(array ('exchangeViewModel' => $this->getExchangeData()),
                    'exchange/exchange/currencies.phtml');
        }
        return $this->goToLogin();
    }

}
