<?php

namespace Exchange\Models\Entities;

use Exchange\Models\Entities\Base\EntityBase;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity(repositoryClass="Exchange\Models\Repositories\UsersRepository") */
class Users extends EntityBase {

    public function __construct() {
        parent::__construct();
        $this->Currencies = new ArrayCollection();
    }
    
    /** @ORM\Column(type="string") */
    protected $Email;
	public function setEmail($email) {
            $this->Email = $email;
            return $this;
	}
	public function getEmail() {
            return $this->Email;
	}
	public function validEmail(){
            return [
                'Type' 			=> 'email',
            ];
        }
        
    /** @ORM\Column(type="string") */
    protected $Password;
	public function setPassword($password) {
            $this->Password = $password;
            return $this;
	}
	public function getPassword() {
            return $this->Password;
	}
	public function validPassword(){
            return [
                'Type' 			=> 'password',
            ];
        }

    /** @ORM\Column(type="string") */
    protected $FirstName;
	public function setFirstName($firstName) {
		$this->FirstName = $firstName;
		return $this;
	}
	public function getFirstName() {
		return $this->FirstName;
	}
	public function validFirstName(){
            return [
                'Type' 			=> 'string',
            ];
        }
        
    /** @ORM\Column(type="string") */
    protected $LastName;
	public function setLastName($lastName) {
		$this->LastName = $lastName;
		return $this;
	}
	public function getLastName() {
		return $this->LastName;
	}
	public function getFullName() {
		return $this->getFirstName () . ' ' . $this->getLastName ();
	}
	public function validLastName(){
            return [
                'Type' 			=> 'string',
            ];
        }
        
    /**
     * @ORM\OneToOne(targetEntity="Wallet", mappedBy="Users")
     */
	protected $Wallet;
	public function setWallet($walet) {
		$this->Wallet = $walet;
		return $this;
	}
	public function getWallet() {
		return $this->Wallet;
	}

    /**
     * 
     * @ORM\ManyToMany(targetEntity="CurrenciesName")
     * @ORM\JoinTable(name="CurrenciesName_Users",
     *      joinColumns={@ORM\JoinColumn(name="Users_id", referencedColumnName="id", unique=true)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="CurrenciesName_id", referencedColumnName="id", unique=true)}
     *      )
     */
     protected $Currencies;
	public function setCurrencies($currencies) {
		$this->Currencies = $currencies;
		return $this;
	}
	public function getCurrencies() {
		return $this->Currencies;
	}
	public function addCurrencies($currency){
		$this->Currencies->add($currency);
	}
        
    /**
     * @ORM\OneToMany(targetEntity="LogsSales", mappedBy="Users")
     *
     */
    protected $LogSales;
	public function setLogSales($logSales) {
		$this->LogSales = $logSales;
		return $this;
	}
	public function getLogSales() {
		return $this->LogSales;
	}
        
	/**
	 *
	 * @ORM\ManyToOne(targetEntity="Users", inversedBy="Children")
	 * @ORM\JoinColumn(name="Parent", referencedColumnName="id")
	 */
	protected $Parent;
	public function setParent($parent) {
		$this->Parent = $parent;
		return $this;
	}
	public function getParent() {
		return $this->Parent;
	}

        	/**
	 * @ORM\OneToMany(targetEntity="Users", mappedBy="Parent")
	 */
	protected $Children;
	public function setChildren($children) {
		$this->Children = $children;
		return $this;
	}
	public function getChildren() {
		return $this->Children;
	}
	public function hasChildren(){
		if ($this->Children->count()!= 0){
			return true;
		}
		return false;
	}
	public function getNumberOfChildren(){
		return $this->Children->count();
	}

        public function exchangeArray($data) {
        $this->id 		= (! empty ( $data [$this->getFieldName('id')] )) 		? $data [$this->getFieldName('id')] 		: null;
        $this->Email 		= (! empty ( $data [$this->getFieldName('Email')] )) 		? $data [$this->getFieldName('Email')] 		: null;
        $this->FirstName 	= (! empty ( $data [$this->getFieldName('FirstName')] )) 	? $data [$this->getFieldName('FirstName')] 	: null;
        $this->LastName 	= (! empty ( $data [$this->getFieldName('LastName')] )) 	? $data [$this->getFieldName('LastName')] 	: null;
        $this->Password   	= (! empty ( $data [$this->getFieldName('Password')] ))          ? $data [$this->getFieldName('Password')] 	: null;
	$this->Parent 		= (! empty ( $data [$this->getFieldName('Parent')] )) 		? $data [$this->getFieldName('Parent')] 	: null;
   }

    public function getArrayValue (){
        return [
            'id'                => $this->id,
            'Email' 		=> $this->Email,
            'FirstName' 	=> $this->FirstName,
            'LastName' 		=> $this->LastName ,
            'Password' 		=> $this->Password ,
       ];
    }	
}
