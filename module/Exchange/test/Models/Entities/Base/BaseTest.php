<?php
namespace ExchangeTest\Models\Entities\Base;

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    const ENTITIES_DOMAIN = "Exchange\Models\Entities";
    
    private function getPropertyArrayName($name, $property){
        return $name.'.'.$property;
    }
    
    private function createNewInstance($name){
        $entit = self::ENTITIES_DOMAIN."\\".$name;
        return new $entit();
    }
    
    /* TODO : 
     * after your setter function,another function create
     * and it should be started name of function property with prefix 'valid'
     */ 
    private function createMockData($name, $entity, $properties){
        $data = [];
        foreach ( $properties as $property) {
            $fanc = 'valid'.$property;
            $typeProperty = $entity->$fanc()['Type'];
            $data[$this->getPropertyArrayName($name, $property)] = $this->returnMockBaseType($typeProperty);
        }
        return $data;  
    }
    
    private function returnMockBaseType($type){
        switch ($type){
            case "string":
                return "some string";
            case "integer":
                return 123;
            case "email":
                return "example@domain.com";
            case "datetime":
                return "yyyy-mm-dd";
            case "password":
                return hash ( 'md5', 'Password' );
        }       
    }
    
    public function doAssertNull ($name, $properties){
        $entity = $this->createNewInstance($name);
        $message = " should be null by default";       
        foreach ( $properties as $property) {
            $func = "get".$property;
            $this->assertNull($entity->$func(), '"'.$this->getPropertyArrayName($name, $property).'"'. $message);
        }
    }
    
    public function doExchangeArraySetsPropertiesCorrectly ($name, $properties){
        $entity = $this->createNewInstance($name);
        $message = " was not set correctly";
        
        $data = $this->createMockData($name, $entity, $properties);
        $entity->exchangeArray($data);
        
        foreach ( $properties as $property) {
            $func = "get".$property;
            $this->assertSame($data[$this->getPropertyArrayName($name, $property)], $entity->$func(), '"'.$this->getPropertyArrayName($name, $property).'"'. $message);
        }
    }
    
    public function doExchangeArraySetsPropertiesToNullIfKeysAreNotPresent($name, $properties){
        $entity = $this->createNewInstance($name);
        $message = " should default to null";
        
        $data = $this->createMockData($name, $entity, $properties);
        $entity->exchangeArray($data);
        
        $data = [];
        $entity->exchangeArray($data);
        
        foreach ( $properties as $property) {
            $func = "get".$property;
            $this->assertNull( $entity->$func(), '"'.$this->getPropertyArrayName($name, $property).'"'. $message);
        }
      

  
    }

    public function doGetArrayCopyReturnsAnArrayWithPropertyValues($name, $properties){
        $entity = $this->createNewInstance($name);
        $message = " was not set correctly";
    
        $data = $this->createMockData($name, $entity, $properties);
        $entity->exchangeArray($data);

        $copyArray = $entity->getArrayValue();
        
        foreach ( $properties as $property) {
            $this->assertSame($data[$this->getPropertyArrayName($name, $property)], $copyArray[$property], '"'.$this->getPropertyArrayName($name, $property).'"'. $message);
        }
    }

}