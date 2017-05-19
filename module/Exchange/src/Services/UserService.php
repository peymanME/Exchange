<?php 
namespace Exchange\Services;

use Exchange\Services\Base\ServiceBase;
use Exchange\Services\Abstracts\Interfaces\UserServiceInterface;
use Exchange\Models\Entities\Users;
use Exchange\Services\Abstracts\Interfaces\AuthServiceInterface;

class UserService extends ServiceBase implements UserServiceInterface, AuthServiceInterface 
{
    private $authService;
    
    public function __construct($entityManager, $authenticationService) {
        parent::__construct($entityManager);
        
        $this->authService = new AuthService($entityManager, $authenticationService);
    }
    
    

    public function register ($entityArray){
        $users = $this->getEntity(Users::class, $entityArray);
        $users->setPassword(hash ( 'md5', $users->getPassword () ));
        return $this->save($users); 
    }
    
    public function login ($dataFormArray){
        return $this->authService->login($dataFormArray);
    }
    
    public function is_Authenticate(){
        return $this->authService->is_Authenticate();
    }

    public function authClean() {
        $this->authService->authClean();       
    }

    public function getUserName() {
        return $this->authService->getUserName();
    }

    public function getUserObj() {
        return $this->authService->getUserObj();     
    }

}