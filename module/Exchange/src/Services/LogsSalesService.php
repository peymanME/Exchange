<?php
namespace Exchange\Services;

use Exchange\Services\Base\ServiceBase;
use Exchange\Services\Abstracts\Interfaces\LogsSalesServiceInterface;
use Exchange\Models\Entities\LogsSales;
use Exchange\Models\Entities\CurrenciesPrice;



class LogsSalesService extends ServiceBase implements  LogsSalesServiceInterface 
{
    protected  $userService;
    public function __construct($entityManager, $authenticationService) {
        parent::__construct($entityManager);
        $this->userService = new UserService($entityManager, $authenticationService);
        }
    
    public function setLogs(CurrenciesPrice $currency , $price , $sell){
        $logsSales = new LogsSales();
        $logsSales->setAmount($currency->getUnit());
        $logsSales->setWorth($price);
        $logsSales->setCurrenciesName($currency->getCurrenciesName());
        $logsSales->setDateRegister(new \DateTime('now'));
        $logsSales->setSell($sell);
        $logsSales->setUsers($this->userService->getUserObj());
        $this->save($logsSales);
    }
   
}