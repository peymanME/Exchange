<?php 
namespace Exchange\Helper\Factories;
use Interop\Container\ContainerInterface;

class HelperFactory
{
    private $entityManager;
    private $authenticationService;
    private $requestedName;
    
    public function __construct(ContainerInterface $container, $requestedName, array $options = null) {
        $this->entityManager = $container->get('doctrine.entitymanager.orm_default');
        $this->authenticationService = $container->get('doctrine.authenticationservice.orm_default');
        $this->requestedName = $requestedName;
    }
    public function init(){
        
        return new $this->requestedName($this->entityManager, $this->authenticationService);
        
    }

}
