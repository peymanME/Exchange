<?php
namespace Exchange\Models\ViewModels;

use Exchange\Models\ViewModels\Base\ViewModelBase;

class SettingViewModel extends ViewModelBase 
{
    
    public function __construct(){
        $this->WalletViewModel = new WalletViewModel();        
    }
    
    protected $WalletViewModel;
        public function getWalletViewModel(){
            return $this->WalletViewModel;
        }
	public function setWalletViewModel($walletViewModel) {
            $this->WalletViewModel = $walletViewModel;
            return $this;
	}

}