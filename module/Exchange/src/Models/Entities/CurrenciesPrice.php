<?php

namespace Exchange\Models\Entities;

use Exchange\Models\Entities\Base\EntityBase;
use Exchange\Models\Entities\CurrenciesName;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity(repositoryClass="Exchange\Models\Repositories\CurrenciesPriceRepository") */
class CurrenciesPrice extends EntityBase {

    public function __construct() {
        parent::__construct();
        $this->CurrenciesName = new CurrenciesName();
    }
    
     /**
     * @ORM\ManyToOne(targetEntity="CurrenciesName")
     * @ORM\JoinColumn(name="CurrenciesName_id", referencedColumnName="id")
     */
    protected $CurrenciesName;
	public function setCurrenciesName($currenciesName) {
		$this->CurrenciesName = $currenciesName;
		return $this;
	}
	public function getCurrenciesName() {
		return $this->CurrenciesName;
	}

    /** @ORM\Column(type="string") */
    protected $Code;
	public function setCode($code) {
            $this->Code = $code;
            return $this;
	}
	public function getCode() {
            return $this->Code;
	}
	public function validCode(){
            return [
                'Type' 			=> 'string',
                'Requiered'		=> true,
            ];
        }
        
    /** @ORM\Column(type="string") */
    protected $Name;
	public function setName($name) {
            $this->Name = $name;
            return $this;
	}
	public function getName() {
            return $this->Name;
	}
	public function validName(){
            return [
                'Type' 			=> 'string',
                'Requiered'		=> true,
            ];
        }

    /** @ORM\Column(type="decimal", precision=15, scale=2) */
    protected $SellPrice;
	public function setSellPrice($sellPrice) {
            $this->SellPrice = $sellPrice;
            return $this;
	}
	public function getSellPrice() {
            return $this->SellPrice;
	}
	public function validSellPrice(){
            return [
                'Type' 			=> 'decimal(15,2)',
                'Requiered'		=> true,
            ];
        }

    /** @ORM\Column(type="integer") */
    protected $Unit;
	public function setUnit($unit) {
            $this->Unit = $unit;
            return $this;
	}
	public function getUnit() {
            return $this->Unit;
	}
	public function validUnit(){
            return [
                'Type' 			=> 'integer',
                'Requiered'		=> true,
            ];
        }

        
    /** @ORM\Column(type="decimal", precision=15, scale=2) */
    protected $PurchasePrice;
	public function setPurchasePrice($purchasePrice) {
            $this->PurchasePrice = $purchasePrice;
            return $this;
	}
	public function getPurchasePrice() {
            return $this->PurchasePrice;
	}
	public function validPurchasePrice(){
            return [
                'Type' 			=> 'decimal(15,2)',
                'Requiered'		=> true,
            ];
        }

    /** @ORM\Column(type="decimal", precision=15, scale=2) */
    protected $AveragePrice;
	public function setAveragePrice($averagePrice) {
            $this->AveragePrice = $averagePrice;
            return $this;
	}
	public function getAveragePrice() {
            return $this->AveragePrice;
	}
	public function validAveragePrice(){
            return [
                'Type' 			=> 'decimal(15,2)',
                'Requiered'		=> true,
            ];
        }

    /** @ORM\Column(type="datetime") */
    protected $DateRegister;
	public function setDateRegister($dateRegister) {
            $this->DateRegister = $dateRegister;
            return $this;
	}
	public function getDateRegister() {
            return $this->DateRegister;
	}
	public function getFullDateRegisterTostring(){
            if ($this->DateRegister !== null){
                return $this->DateRegister->format('Y-m-d H:i:s');
            }
            return $this->DateRegister;
	}
	public function validDateRegister(){
            return [
                'Type' 			=> 'datetime',
                'Requiered'		=> true,
            ];
        }
        
    public function exchangeArray($data) {
        $this->id 		= (! empty ( $data [$this->getFieldName('id')] )) 		? $data [$this->getFieldName('id')] 		: null;
        $this->AveragPeice      = (! empty ( $data [$this->getFieldName('AveragPeice')] ))      ? $data [$this->getFieldName('AveragPeice')]    : null;
        $this->DateRegister 	= (! empty ( $data [$this->getFieldName('DateRegister')] )) 	? $data [$this->getFieldName('DateRegister')] 	: null;
        $this->PurchasePrice 	= (! empty ( $data [$this->getFieldName('PurchasePrice')] )) 	? $data [$this->getFieldName('PurchasePrice')] 	: null;
        $this->SellPrice   	= (! empty ( $data [$this->getFieldName('SellPrice')] ))        ? $data [$this->getFieldName('SellPrice')] 	: null;
        $this->CurrenciesName->exchangeArray ( $data );
   }

    public function getArrayValue (){
        return [
            'id'                => $this->id,
            'AveragPeice'       => $this->AveragPeice,
            'DateRegister' 	=> $this->DateRegister,
            'PurchasePrice'     => $this->PurchasePrice ,
            'SellPrice'         => $this->SellPrice ,
            'CurrenciesName_id' => $this->getCurrenciesName()->getid(),
       ];
    }	
}
