<?php
namespace ExchangeTest\Models\Entities;

use ExchangeTest\Models\Entities\Base\BaseTest;

class UserTest extends BaseTest {
    
    protected $entity;
    protected $properties;
    
    function __construct($name = null, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
        
        $this->entity = "Users";
        
        $this->properties = [
            "id",
            "FirstName",
            "LastName",
            "Email",
            "Password",
        ];
   }
    
    public function testInitialUserValuesAreNull() {
        $this->doAssertNull($this->entity, $this->properties);
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $this->doExchangeArraySetsPropertiesCorrectly($this->entity, $this->properties);
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {        
        $this->doExchangeArraySetsPropertiesToNullIfKeysAreNotPresent($this->entity, $this->properties);
    }

    public function testGetArrayCopyReturnsAnArrayWithPropertyValues()
    {
        $this->doGetArrayCopyReturnsAnArrayWithPropertyValues($this->entity, $this->properties);
    }

//    public function testInputFiltersAreSetCorrectly()
//    {
//        $user = new User();
//
//        $inputFilter = $user->getInputFilter();
//
//        $this->assertSame(3, $inputFilter->count());
//        $this->assertTrue($inputFilter->has('artist'));
//        $this->assertTrue($inputFilter->has('id'));
//        $this->assertTrue($inputFilter->has('title'));
//    }
}