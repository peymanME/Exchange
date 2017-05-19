<?php
namespace Exchange\Services;

use Exchange\Services\Abstracts\Interfaces\ManagerServiceInterface;

class ManagerService implements ManagerServiceInterface 
{
    private $authService;
    private $entityManager;
    
    public function __construct($entityManager, $authenticationService) {
        $this->authService = $authenticationService;
        $this->entityManager = $entityManager;
    }
    
    public function getAuthService(){
        return $this->authService;
    }
    
    public function getEntityManager(){
        return $this->entityManager;
    }
}