<?php
namespace Exchange\Services;

use Exchange\Services\Abstracts\Interfaces\AuthServiceInterface;

class AuthService implements AuthServiceInterface 
{
    private $authService;
    private $entityManager;
    
    public function __construct($entityManager, $authenticationService) {
        $this->authService = $authenticationService;
        $this->entityManager = $entityManager;
    }
    
    public function is_Authenticate(){
        $auth = $this->authService->getIdentity();
        return (isset($auth))? true : false;
    }
    
    public function getUserName(){
        $auth = $this->authService->getIdentity();
        return (isset($auth))? $auth->getFullName() : null;
    }

    public function getUserObj(){
        $auth = $this->authService->getIdentity();
        return (isset($auth))? $auth : null;
    }
    
    public function authClean(){
        $this->authService->getStorage()->clear();    
    }
    
    public function login($dataFormArray){        
        $adapter = $this->authService->getAdapter();
        
        $adapter->setOptions(array( 
            'objectManager'     => $this->entityManager, 
            'identityClass'     => 'Exchange\Models\Entities\Users', 
            'identityProperty'  => 'Email', 
            'credentialProperty'=> 'Password' ));
        
        $adapter->setIdentity($dataFormArray['Email']);
        $adapter->setCredential(hash ( 'md5', $dataFormArray['Password'] ));
        $authResult = $this->authService->authenticate();
        
        if ($authResult->isValid()) {
            $identity = $authResult->getIdentity();
            $this->authService->getStorage()->write($identity);
            return true;             
        }
        return false;
    }
}