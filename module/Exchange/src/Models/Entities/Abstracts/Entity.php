<?php

namespace Exchange\Models\Entities\Abstracts;


use Exchange\Infrastructure\Exception\Services\ExceptionService;

abstract class Entity {
	

    public function __construct() {
    }

    public function __get($property){
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function getDateToString($date){
        return $date->format('Y-m-d');
    }

    abstract protected function exchangeArray($data);

    abstract protected  function getArrayValue ();

    protected function getFieldName ($name){
        return (new \ReflectionClass($this))->getShortName() . '.'. $name;
    }

    public function mapFormToObject($dataFormArray){
        foreach ($dataFormArray as $key => $value){
            $oldkey = $key;
            $key = str_replace("_",".",$key,$count);
            if 	(! $count){
                    $key = $this->getFieldName($key);
            }				
            $dataFormArray[$key] = $dataFormArray[$oldkey];
            unset($dataFormArray[$oldkey]);
        }
        $this->exchangeArray($dataFormArray);
        return $this;
    }
   
    
    public function mapObjectToObject($object){
        $array = $object->getArrayValue();

        foreach ($array as $field=>$value){
            //if ($value !== null){
                if (strpos($field, '_'))
                    $this->haybrid($field, $value);
                else{
                    $func = 'set'. $field;
                    //$this->exceptionService->Invoke_Debuge($func);
                    $this->$func($value);
                }
            //}
        }
        return $this;
    }

    private function haybrid ($field, $value){
        $array = explode("_", $field );
        $func = 'get'.$array[0];
        $entity = $this->$func();
        $func = 'set'.$array[1];
        $entity->$func($value);
		
    }
	
}
