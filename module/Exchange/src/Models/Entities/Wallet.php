<?php

namespace Exchange\Models\Entities;

use Exchange\Models\Entities\Base\EntityBase;
use Exchange\Models\Entities\Users;

use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity(repositoryClass="Exchange\Models\Repositories\WalletRepository") */
class Wallet extends EntityBase {

    public function __construct() {
        parent::__construct();
        $this->Users = new Users(); 
    }
    
    /** @ORM\Column(type="decimal", precision=15, scale=2) */
    protected $Cash;
	public function setCash($cash) {
            $this->Cash = $cash;
            return $this;
	}
	public function getCash() {
            return $this->Cash;
	}
	public function validCash(){
            return [
                'Type' 			=> 'decimal(15,2)',
                'Requiered'		=> true,
            ];
        }
        
    /**
     * 
     * @ORM\OneToOne(targetEntity="Users" , inversedBy="Wallet")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $Users;
	public function setUsers($users) {
            $this->Users = $users;
            return $this;
	}
	public function getUsers() {
            return $this->Users;
	}

       


    public function exchangeArray($data) {
        $this->id 		= (! empty ( $data [$this->getFieldName('id')] )) 	? $data [$this->getFieldName('id')] 	: null;
        $this->Cash 		= (! empty ( $data [$this->getFieldName('Cash')] )) 	? $data [$this->getFieldName('Cash')] : null;
        $this->Users->exchangeArray ( $data );
   }

    public function getArrayValue (){
        return [
            'Cash' 		=> $this->Cash,
            'id' 		=> $this->Users->getid() ,
        ];
    }	
}
