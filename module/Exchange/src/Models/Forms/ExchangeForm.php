<?php
namespace Exchange\Models\Forms;

use Zend\Form\Form;
use Zend\Form\Element\Button;
use Zend\Form\Element\Hidden;

class ExchangeForm extends Form
{   
  public function __construct($sell, $url){
    
    
    parent::__construct('ExchangeForm');
    
    if ($sell){
        $value = "Sell";
    }else{
        $value = "Buy";
    }
    
    $code = new Hidden("Code");
    $this->add($code);
    
    $btton = new Button('DoExchange',            // Name of the element
                [                     // Array of options
                 'label'=> $value  // Text label
                ]);
    $btton->setAttributes(array (
        'id' => 'DoExchange',
        'value' => $value,
        'onclick'=>"(function (){require('./home/home').exchangeFormSubmit('".$url."');})();",
        'class'    => "btn btn-default"));
    $this->add($btton);

    $this->addInputFilter(); 
  }
  
  private function addInputFilter() 
  {
    $inputFilter = new \Zend\InputFilter\InputFilter();        
    $this->setInputFilter($inputFilter);
    

    $inputFilter->add([
        'name'     => 'Code',
        'required' => true,
        'allowEmpty' => false,
        'filters'  => [
           ['name' => 'StringTrim'],
           ['name' => 'StripTags'],
           ['name' => 'StripNewlines'],
        ],                
        'validators' => [
           [
            'name' => 'StringLength',
              'options' => [
                'min' => 3,
                  'maz'=>3
              ],
           ],
        ],
      ]
    );   

  }
}