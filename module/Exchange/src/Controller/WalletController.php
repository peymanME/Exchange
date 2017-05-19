<?php

namespace Exchange\Controller;

use Exchange\Controller\Base\ControllerBase;
use Exchange\Models\ViewModels\WalletViewModel;
use Exchange\Models\ViewModels\CurrenciesViewModel;
use Exchange\Models\Forms\CurrenciesForm;
use Exchange\Models\Forms\ExchangeForm;
use Exchange\Services\CurrencyService;
use Exchange\Services\CurrenciesPriceService;
use Exchange\Services\WalletService;
use Exchange\Models\Entities\CurrenciesName;
use Exchange\Services\UserService;

class WalletController extends ControllerBase
{
    protected $currencyService;
    protected $walletService;
    protected $currenciesPriceService;
    protected $userService;
    
    function __construct($entityManager, $authenticationService) {
        parent::__construct($entityManager, $authenticationService);
        $this->currencyService  = new CurrencyService($entityManager, $authenticationService);
        $this->walletService = new WalletService($entityManager, $authenticationService);
        $this->currenciesPriceService = new CurrenciesPriceService($entityManager, $authenticationService);
        $this->userService = new UserService($entityManager, $authenticationService);
    }

    public function indexAction(){
        $this->getLogs();
        
        if ($this->userService->is_Authenticate()){
            $currenciesViewModel  = new CurrenciesViewModel();

            $curencies = $this->currencyService->listOfNoPage(CurrenciesName::class);
            
            $currenciesViewModel->setForm(new CurrenciesForm($curencies));


            $request = $this->getRequest ();

            if ($request->isPost ()) {

                $currenciesViewModel->getForm()->setData ( $request->getPost () );

                 if ($currenciesViewModel->getForm()->isValid ()) {
                    $this->currencyService->addToWalet($currenciesViewModel->getForm()->getData());
                    $currenciesViewModel->setErrorMessage("it was successfully registered");
                }
            }        

      
         
            return $this->jsonModel(array ('currenciesViewModel'=>$currenciesViewModel),
                    'exchange/wallet/currencies.phtml');
        }
        return $this->goToLogin();
    }



//    public function settingAction(){
//        
//        $settingViewModel  = new SettingViewModel();
//        
//        
//        
//        
//        //$settingViewModel->setWalletViewModel($this->getWalletValues());       
//        return $this->viewModel(array ('settingViewModel'=>$settingViewModel));
//    }
    
//    public function currenciesAction(){
//        $currenciesViewModel  = new CurrenciesViewModel();
//        
//        $curencies = $this->currencyService->listOf(0);
//                
//        $currenciesViewModel->setForm(new CurrenciesForm($curencies));
//        
//        $request = $this->getRequest ();
//        
//        if ($request->isPost ()) {
//            
//            $currenciesViewModel->getForm()->setData ( $request->getPost () );
//
//             if ($currenciesViewModel->getForm()->isValid ()) {
//                $this->currencyService->addToWalet($currenciesViewModel->getForm()->getData());
//                $currenciesViewModel->setErrorMessage("it was successfully registered");
//            }
//        }        
//        return $this->viewModel(array ('currenciesViewModel'=>$currenciesViewModel));
//    }

    public function walletAction(){        
        return $this->viewModel(array ('walletViewModel'=>$this->getWalletValues()));
    }
    
    private function getWalletValues(){
        $walletViewModel = new WalletViewModel();
        $walletViewModel->setListOf($this->walletService->getWalletValues()->getWallet());
        return $walletViewModel;     
    }
    
    public function buyAction(){
        $this->getLogs();
        
        if ($this->userService->is_Authenticate()){
            
            $currenciesViewModel  = new CurrenciesViewModel();
            
            $currencyCode = $this->params('currency');
            
            $currenciesViewModel->setWallet($this->walletService->getWalletValues());
            $currency = $this->currenciesPriceService->sessionToObject($currencyCode);
            $currenciesViewModel->setCurrency($currency );
            $url = $this->url()->fromRoute("wallet", array('action'=> 'buy', 'currency'=> $currencyCode) );
            $currenciesViewModel->setForm( new ExchangeForm(false, $url) );
            
            $request = $this->getRequest ();
            
            if ($request->isPost ()) {
                
                $currenciesViewModel->getForm()->setData ( $request->getPost () );
                
                    if ($currenciesViewModel->getForm()->isValid ()) {
                        
                        $buy = $this->walletService->buyCurrency($currency);
                        return $this->redirect ()->toRoute ('exchange');
                    }
            }
                       
            return $this->jsonModel(array ('currenciesViewModel'=> $currenciesViewModel),
                    "exchange/wallet/wallet.phtml");           
        }
        return $this->goToLogin();
        
    }
    public function sellAction(){
        $this->getLogs();
        
        if ($this->userService->is_Authenticate()){
            
            $currenciesViewModel  = new CurrenciesViewModel();
            
            $currencyCode = $this->params('currency');
            
            $currenciesViewModel->setWallet($this->walletService->getWalletValues());
            $currency = $this->currenciesPriceService->sessionToObject($currencyCode);
            $currenciesViewModel->setCurrency($currency );
            $url = $this->url()->fromRoute("wallet", array('action'=> 'sell', 'currency'=> $currencyCode) );
            $currenciesViewModel->setForm( new ExchangeForm(true, $url) );
            
            $request = $this->getRequest ();
            
            if ($request->isPost ()) {
                
                $currenciesViewModel->getForm()->setData ( $request->getPost () );
                
                    if ($currenciesViewModel->getForm()->isValid ()) {
                        
                        $buy = $this->walletService->sellCurrency($currency);
                        return $this->redirect ()->toRoute ('exchange');
                    }
            }
                       
            return $this->jsonModel(array ('currenciesViewModel'=> $currenciesViewModel),
                    "exchange/wallet/wallet.phtml");           
        }
        return $this->goToLogin();
        
    }
}
