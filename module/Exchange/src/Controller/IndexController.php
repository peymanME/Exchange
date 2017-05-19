<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Exchange\Controller;

use Exchange\Controller\Base\ControllerBase;
use Exchange\Models\ViewModels\AuthViewModel;
use Exchange\Models\Forms\LoginForm;
use Exchange\Models\Forms\RegisterForm;
use Exchange\Services\UserService;

class IndexController extends ControllerBase { 
    
    protected $userService;
    
    function __construct($entityManager, $authenticationService) {
        parent::__construct($entityManager, $authenticationService);
        
        $this->userService = new UserService($entityManager, $authenticationService);
    }

    public function loginAction(){

        $this->getLogs();
                
        if ($this->userService->is_Authenticate()){
             $this->userService->authClean();
        }
        $obj = $this->prepareFirstPage($this->getRequest ());
        if (is_object($obj)){
            return $this->jsonModel(array (
                'authViewModel' =>  $obj),
                'exchange/home/index.phtml'); 
        }
        else {
            return $this->redirect()->toRoute('exchange');   
        }        
    }
    
    protected function prepareFirstPage($request){
        $authViewModel  = new AuthViewModel();
        $authViewModel->setForm(new LoginForm());
        if ($request->isPost ()) {            
            $authViewModel->getForm()->setData ( $request->getPost () );
             if ($authViewModel->getForm()->isValid ()) {
                $data = $authViewModel->getForm()->getData();
                if($this->userService->login($data)){
                   return true; 
                }           
            else {
                $authViewModel->setErrorMessage('Username or password is not correct!!');
                }                   
            }
        }       
        return $authViewModel;  
    }
    
    public function indexAction(){
        $this->loggerService->recordLog($this->getClientStatus());
        
        $obj = $this->prepareFirstPage($this->getRequest ());
        if (is_object($obj)){
            return $this->viewModel(array ('authViewModel'=>$obj),
                    'exchange/home/index.phtml'); 
        }
        else {
            return $this->redirect ()->toRoute ('access');
        }                
    }
        
    public function registerAction(){
        $this->getLogs();
        $authViewModel  = new AuthViewModel();
        $authViewModel->setForm(new RegisterForm());
        $request = $this->getRequest ();
        
        if ($request->isPost ()) {
            
            $authViewModel->getForm()->setData ( $request->getPost () );

             if ($authViewModel->getForm()->isValid ()) {
                $this->userService->register($authViewModel->getForm()->getData());
                return $this->redirect ()->toRoute ( 'home', array('action' => 'login') );
            }
        }        
        return $this->jsonModel(array ('authViewModel'=>$authViewModel),
                'exchange/home/register.phtml');
    }
    
    
}
