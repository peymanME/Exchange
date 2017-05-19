<?php
namespace Exchange\Controller\Base;

use Exchange\Infrastructure\Logger\Services\LoggerService;
use Exchange\Infrastructure\Exception\Services\ExceptionService;
use Exchange\Services\UserService;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\PhpEnvironment\RemoteAddress;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ControllerBase extends AbstractActionController {
    
    protected $exceptionService;
    protected $entityManager;
    protected $loggerService;
    protected $userService;

    public function __construct($entityManager, $authenticationService) {
        $this->exceptionService = new ExceptionService();
        $this->loggerService = new LoggerService();
        $this->entityManager = $entityManager;
        $this->userService      = new UserService($authenticationService, $entityManager);
}

    protected function getClientAddress(){
        $remote = new RemoteAddress();
        return $remote->getIpAddress();
    }

    protected function getClientStatus(){
        return array('Ip'=> $this->getClientAddress(), 'Path'=> get_class($this), 'Controller' => $this->getControllerName(), 'Action'=>$this->getActionName() );
    }

    protected function getActionName(){
        return $this->params('action');
    }

    protected function getControllerName(){
        $pieces = explode("\\", $this->params('controller'));
        return end($pieces) ;
    }

    protected function ActiveMenu(){
        $this->layout ()->setVariable ( 'manageMenuActive', '#'. $this->getControllerName() );
    }

    protected function jsonModel($variableArray = null, $template = null){
        $jsonModel = new JsonModel();
        return $this->getModel($jsonModel, $variableArray, $template);
    }

    protected function viewModel($variableArray = null, $template = null){
        $viewModel = new ViewModel();
        return $this->getModel($viewModel, $variableArray, $template);
    }
    
    private function getModel($model, $variableArray, $template){
        if (!is_null($variableArray)){
            $model->setVariables ( $variableArray );
        }
        if (!is_null($template)){
            $model->setTemplate ($template);
        }
        return $model;
    }
    
    public function goToLogin(){
        return $this->redirect ()->toRoute ( 'home' ,array('action' => 'login'));
    }
    
    public function getLogs(){
        $this->loggerService->recordLog($this->getClientStatus());
    }
}
