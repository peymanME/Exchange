<?php
namespace Exchange\Models\ViewModels;

use Exchange\Models\ViewModels\Base\ViewModelBase;

class ExchangeViewModel extends ViewModelBase 
{
    
    public function __construct(){
        $this->CurrenciesViewModel = new CurrenciesViewModel();
    }
    
    protected $CurrenciesViewModel;
        public function getCurrenciesViewModel(){
            return $this->CurrenciesViewModel;
        }
	public function setCurrenciesViewModel($currenciesViewModel) {
            $this->CurrenciesViewModel = $currenciesViewModel;
            return $this;
	}
        
    protected $Cash;
        public function getCash(){
            return $this->Cash;
        }
	public function setCash($cash) {
            $this->Cash = $cash;
            return $this;
	}
 
}