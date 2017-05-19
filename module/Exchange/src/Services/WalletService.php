<?php
namespace Exchange\Services;

use Exchange\Services\Base\ServiceBase;
use Exchange\Services\Abstracts\Interfaces\WalletServiceInterface;

class WalletService extends ServiceBase implements  WalletServiceInterface 
{
    protected $userService;
    protected $logsSalesService;
    
    public function __construct($entityManager, $authenticationService) {
        parent::__construct($entityManager);
        
        $this->userService = new UserService($entityManager, $authenticationService);
        $this->logsSalesService = new LogsSalesService($entityManager, $authenticationService);
    }
    
    public function getWalletValues(){
        return $this->userService->getUserObj()->getWallet();
    }
    
    public function buyCurrency($currency){
        
        $wallet = $this->getWalletValues();
        $cash = $wallet->getCash();
        $price = $currency->getPurchasePrice();
        if ((float)$cash >= (float)$price){
            $cashCurrently = $cash - $price;
            $wallet->setCash($cashCurrently);
        }
        $this->save($wallet);
        $this->logsSalesService->setLogs($currency, $price, false);
   
    }
    
    public function sellCurrency($currency){
        
        $wallet = $this->getWalletValues();
        $cash = $wallet->getCash();
        $price = $currency->getPurchasePrice();
        if ((float)$cash >= (float)$price){
            $cashCurrently = $cash + $price;
            $wallet->setCash($cashCurrently);
        }
        $this->save($wallet);
        $this->logsSalesService->setLogs($currency, $price, false);
   
    }
}