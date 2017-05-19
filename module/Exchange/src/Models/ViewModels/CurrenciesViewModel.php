<?php
namespace Exchange\Models\ViewModels;

use Exchange\Models\ViewModels\Base\ViewModelBase;
use Exchange\Models\Entities\CurrenciesPrice;
use Exchange\Models\Entities\Wallet;
class CurrenciesViewModel extends ViewModelBase 
{
    public function __construct(){
        $this->Currency = new CurrenciesPrice();
        $this->Wallet = new Wallet();
        
    }
    protected $Currency;
        public function setCurrency($currency){
            $this->Currency = $currency;
            return $this;
        }
        public function getCurrency(){
            return $this->Currency;
        }
    
     protected $Wallet;
        public function setWallet($wallet){
            $this->Wallet = $wallet;
            return $this;
        }
        public function getWallet(){
            return $this->Wallet;
        }
   
}
