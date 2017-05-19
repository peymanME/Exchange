<?php

namespace Exchange\Models\Entities;

use Exchange\Models\Entities\Base\EntityBase;
use Exchange\Models\Entities\Users;

use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity(repositoryClass="Exchange\Models\Repositories\LogsSalesRepository") */
class LogsSales extends EntityBase {

    public function __construct() {
        parent::__construct();
        $this->CurrenciesNmae = new CurrenciesName(); 
        $this->Users = new Users(); 
    }

    /** @ORM\Column(type="boolean") */
    protected $Sell;
	public function setSell($sell) {
            $this->Sell = $sell;
            return $this;
	}
	public function getSell() {
            return $this->Sell;
	}
	public function validSell(){
            return [
                'Type' 			=> 'boolean',
                'Requiered'		=> true,
            ];
        }

    
    /** @ORM\Column(type="decimal", precision=15, scale=2) */
    protected $Worth;
	public function setWorth($worth) {
            $this->Worth = $worth;
            return $this;
	}
	public function getWorth() {
            return $this->Worth;
	}
	public function validWorth(){
            return [
                'Type' 			=> 'decimal(15,2)',
                'Requiered'		=> true,
            ];
        }



    /** @ORM\Column(type="decimal", precision=15, scale=2) */
    protected $Amount;
	public function setAmount($amount) {
            $this->Amount = $amount;
            return $this;
	}
	public function getAmount() {
            return $this->Amount;
	}
	public function validAmount(){
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
	public function validDateRegister(){
            return [
                'Type' 			=> 'datetime',
                'Requiered'		=> true,
            ];
        }
        
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Users",  inversedBy="LogsSales")
     * @ORM\JoinColumn(name="Users_id", referencedColumnName="id")
     */
    protected $Users;
	public function setUsers($users) {
            $this->Users = $users;
            return $this;
	}
	public function getUsers() {
            return $this->Users;
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
        


    public function exchangeArray($data) {
        $this->id 		= (! empty ( $data [$this->getFieldName('id')] )) 		? $data [$this->getFieldName('id')] 		: null;
        $this->Amount 		= (! empty ( $data [$this->getFieldName('Amount')] )) 		? $data [$this->getFieldName('Amount')] 	: null;
        $this->Worth 		= (! empty ( $data [$this->getFieldName('Worth')] )) 		? $data [$this->getFieldName('Worth')] 		: null;
        $this->Sell 		= (! empty ( $data [$this->getFieldName('Sell')] )) 		? $data [$this->getFieldName('Sell')] 		: null;
        $this->DateRegister 	= (! empty ( $data [$this->getFieldName('DateRegister')] )) 	? $data [$this->getFieldName('DateRegister')] 	: null;
	$this->CurrenciesName->exchangeArray ( $data );
        $this->Users->exchangeArray ( $data );
   }

    public function getArrayValue (){
        return [
            'id'                => $this->id,
            'Amount' 		=> $this->Amount,
            'Worth' 		=> $this->Worth,
            'Sell' 		=> $this->Sell,
            'DateRegister' 	=> $this->DateRegister,
            'CurrenciesName_id' => $this->getCurrenciesNmae()->getid(),
            'Users_id' 		=> $this->Users->getid() ,
        ];
    }	
}
