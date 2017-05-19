<?php
namespace Exchange\Infrastructure\Exception\Services;

use Exchange\Infrastructure\Exception\Abstracts\ExceptionServiceInterface;

class ExceptionService implements ExceptionServiceInterface {

    public function __construct() {
	}

    public function Invoke_Throw($message){
        throw new \Exception($message);
    }

    public function Invoke_Message(\Exception $e){
        echo $e->getMessage();
    }

    public function Invoke_File(\Exception $e){
        echo $e->getFile();
    }

    public function Invoke_Stop(\Exception $e){
        $this->Invoke_Message($e);
        exit;
    }

    public function Invoke_Debuge($message , $exit = 0){
        echo var_dump($message);
        //echo print_r($message) . '</br><hr/>';
        if ($exit){
            exit;
        }
    }
        
    public function getClassMethod ($class, $exit = 0){
        $class_methods = get_class_methods($class);
        $this->Invoke_Debuge($class_methods, $exit);
    }
}

                //'credential_callable' => 'Application\Controller\IndexController::verifyCredential'
//   public static function verifyCredential(User $user, $inputPassword){
//        return password_verify($inputPassword, $user->getPassword());
//    }
