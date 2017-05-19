<?php
namespace Exchange\Models\ViewModels;

use Exchange\Models\ViewModels\Base\ViewModelBase;
use Exchange\Models\Entities\Wallet;

class WalletViewModel extends ViewModelBase 
{
    public function __construct(){
        $this->Wallet = new Wallet();
    }
    
    protected $Wallet;
        public function getWallet(){
            return $this->Wallet;
        }
	public function setWallet($wallet) {
            $this->Wallet = $wallet;
            return $this;
	}


}