<?php
namespace Exchange\Services;

use Exchange\Services\Base\ServiceBase;
use Exchange\Services\Abstracts\Interfaces\HomeServiceInterface;
use Exchange\Services\Abstracts\BaseServiceInterface;
use Exchange\Models\Entities\Users;

use Zend\Crypt\Password\Bcrypt;
use Zend\Session\Container;

class HomeService extends ServiceBase implements BaseServiceInterface, HomeServiceInterface 
{

    public function __construct($entityManager) {
        parent::__construct($entityManager);		
    }
    
    public function getUserBySession(){
        $sessionUser = new Container('Autenticate');
        return $this->find((int)$sessionUser->Id);
    }
    private function getEntity($entity){
        $users = new Users();
        $users->mapFormToObject($entity);
        return $users;
  
    }

    public function register ($entityArray){
        $users = $this->getEntity($entityArray);
        $users->setPassword(hash ( 'md5', $users->getPassword () ));
        return $this->save($users); 
    }
    
    public function login ($entityArray){
        $user = $this->getEntity($entityArray);
        $userDB = $this->findBy(array('Email'=>$user->getEmail()));
        if (is_array($userDB)){
            if (count($userDB) === 1) {
                return $this->Authenticate($userDB[0], $user);
            }
        }
        return false;
    }
    
    
    
    public function Authenticate($autenticationDB, $authentecation) {
        if ($authentecation) {
            if ($autenticationDB) {
                $bcrypt = new Bcrypt ();
                $userPass = hash ( 'md5', $authentecation->getPassword () );
                $password = $autenticationDB->getPassword();
                $userPass = $bcrypt->create ( $userPass );
                if ($bcrypt->verify ( $password, $userPass )) {
                    $this->createToken($autenticationDB);
                    return true;
                }
            }
        }
        return false;
    }

    private function createToken($authentecation) {
            $sessionToken = new Container ( 'Autenticate' );
            $sessionToken->Aouth    = $authentecation->getFullname ();
            $sessionToken->Id       = ($authentecation->getid ());
            $sessionToken->State    = true;
            //$sessionToken->gid      = com_create_guid ( );
    }
    
    public function deleteToken() {
            $sessionToken = new Container ( 'Autenticate' );
            $sessionToken->getManager ()->getStorage ()->clear ();
    }
    public function Is_Authenticate() {
        $sessionToken = new Container ( 'Autenticate' );
        return ($sessionToken->offsetExists("State"))? $sessionToken->State: false;
    }	
}