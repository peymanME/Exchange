<?php

namespace Exchange\Models\Entities\Base;

use Doctrine\ORM\Mapping as ORM;
use Exchange\Models\Entities\Abstracts\Entity;
use Exchange\Infrastructure\Translator\Helpers\TranslateHelper;


class EntityBase extends Entity{
	
    protected $translate;
    public function __construct() {
        parent::__construct();
        //$this->translate = new TranslateHelper();
    }

    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
	public function setid($id) {
            $this->id = $id;
            return $this;
	}
	public function getid() {
            return $this->id;
	}
	public function validid(){
            return [
                'Type' 			=> 'integer',
            ];
	}
	
	public function exchangeArray($data) {
            $this->id 			= (! empty ( $data [$this->getFieldName('id')] )) 	? $data [$this->getFieldName('id')] 		: null;
	}
	
	public function getArrayValue (){
            return array (
                'id' 	=> $this->getid()
            );
	}
	
}
