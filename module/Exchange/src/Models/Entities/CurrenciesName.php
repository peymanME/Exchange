<?php

namespace Exchange\Models\Entities;

use Exchange\Models\Entities\Base\EntityBase;

use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity(repositoryClass="Exchange\Models\Repositories\CurrenciesNameRepository") */
class CurrenciesName extends EntityBase {

    public function __construct() {
        parent::__construct();
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
        
    /** @ORM\Column(type="string") */
    protected $Code;
	public function setCode($code) {
            $this->Code = $code;
            return $this;
	}
	public function getCode() {
            return $this->Code;
	}
        


    public function exchangeArray($data) {
        $this->id 		= (! empty ( $data [$this->getFieldName('id')] )) 		? $data [$this->getFieldName('id')] 		: null;
        $this->Name 		= (! empty ( $data [$this->getFieldName('Name')] )) 		? $data [$this->getFieldName('Name')] 		: null;
        $this->Code 		= (! empty ( $data [$this->getFieldName('Code')] )) 		? $data [$this->getFieldName('Code')] 		: null;
   }

    public function getArrayValue (){
        return [
            'id'    => $this->id,
            'Name'  => $this->Name,
            'Code'   => $this->Code,
        ];
    }	
}
