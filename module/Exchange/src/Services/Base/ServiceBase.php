<?php
namespace Exchange\Services\Base;

use Exchange\Infrastructure\Exception\Services\ExceptionService;
use Exchange\Services\Abstracts\BaseServiceInterface;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class ServiceBase implements BaseServiceInterface{
    
    const ENTITY_NAMESPACE = 'Exchange\Models\Entities\\';
    
    protected $exceptionService;
    protected $entityManager;

    public function __construct($entityManager) {

        $this->exceptionService     = new ExceptionService();
        $this->entityManager        = $entityManager;
	
    }
    
   public function getEntity($entity, $dataArrayForm){      
        $entity = new $entity();
        $entity->mapFormToObject($dataArrayForm);
        return $entity; 
    }

    public function find($entity, $id){
        return $this->entityManager->find($entity, $id);
    }
    public function findBy($entity, $array){
        return $this->entityManager->getRepository($entity)->findBy($array);
    }
    public function save($entity){
        try{
            if ($entity->getid()===null){		
                $this->entityManager->persist($entity);
            }
            $this->entityManager->flush();
            return $entity;            
        } catch (UniqueConstraintViolationException $ex) {
            return null;
        }        
    }
    public function listOf($page){}
    public function listOfNoPage($entity){
        return $this->entityManager->getRepository($entity)->getList();
    }
    public function delete($id){}  
    
    
	
}