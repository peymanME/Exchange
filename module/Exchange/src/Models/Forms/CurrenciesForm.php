<?php
namespace Exchange\Models\Forms;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Element\Number;
class CurrenciesForm extends Form
{   
  public function __construct($currencies){
    
    
    parent::__construct('CurrenciesForm');
     
   
    $currenciesName = new Select(
                'CurrenciesName',            // Name of the element
                [                     // Array of options
                 'label'=> 'Currency name'  // Text label
                ]);
    $currenciesName->setAttributes(array (
        'id' => 'CurrenciesName',
        'required' => '',
        'class'    => "form-control",
        'multiple' => 'multiple'));
    $currenciesName->setEmptyOption('Please select your currency');
    $array = [];
    foreach($currencies as $c){
        $array[$c->getid()]= $c->getName().' -- '.$c->getCode();
    }
    $currenciesName->setValueOptions($array);
    $this->add($currenciesName);

    $amount = new Number(
                'Money',            // Name of the element
                [                     // Array of options
                 'label'=> 'Money'  // Text label
                ]);
    $amount->setAttributes(array (
        'id' => 'Money',
        'placeholder' => 'My money',
        'required' => true,
        'class'    => "form-control"));
    $this->add($amount);
    $this->addInputFilter(); 
  }
  
  private function addInputFilter() 
  {
    $inputFilter = new \Zend\InputFilter\InputFilter();        
    $this->setInputFilter($inputFilter);
        
    
    $inputFilter->add([
        'name' => 'CurrenciesName',
        'required' => true,
        'allow_empty' => false,
        'filters' => array(
            array('name' => 'Int'),
        ),
//        'validators' => array(
//            array(
//                'name' => 'StringLength',
//                'options' => array(
//                    'encoding' => 'UTF-8',
//                    'min' => '1',
//                    'max' => '6',
//                ),
//            ),
//        ),
    ]);
    $inputFilter->add([
        'name'     => 'Money',
        'required' => true,
        'allowEmpty' => false,
        'filters'  => array(
            array('name' => 'Int'),
        ),
//        'validators' => array(
//            array(
//                'name' => 'number',
//                'options' => array(
//                    'encoding' => 'UTF-8',
//                    'min' => '1',
//                ),
//            ),
//        ),
      ]
    );
    
  }
}