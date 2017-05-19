<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Exchange;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\I18n\Translator;
use Zend\Validator\AbstractValidator;

use Exchange\Services\Abstracts\EntityManagerServiceAbstract;

class Module 
{
    const VERSION = '3.04.01 - 04.01.2017';
    public function onBootstrap(MvcEvent $e) {
        //$translator = $e->getApplication()->getServiceManager ()->get('translator');
        //AbstractValidator::setDefaultTranslator ( new Translator ( $translator ) );
        
        $viewModel = $e->getApplication ()->getMvcEvent ()->getViewModel ();
        $viewModel->version = self::VERSION;
        $this->initSession ( array (
            'remember_me_seconds' => 300,
            'use_cookies' => true,
            'cookie_httponly' => true 
        ) );
    }
     public function initSession($config) {
            $sessionConfig = new \Zend\Session\Config\SessionConfig ();
            $sessionConfig->setOptions ( $config );
            $sessionManager = new \Zend\Session\SessionManager ( $sessionConfig );
            $sessionManager->start ();
            \Zend\Session\Container::setDefaultManager ( $sessionManager );
    }
   
    public function getConfig(){
        $config = array ();
        $configFiles = [
            include __DIR__ . '/../config/module.router.config.php',
            include __DIR__ . '/../config/module.config.php',
            include __DIR__ . '/../config/module.navigation.config.php',				
            //include __DIR__ . '/config/module.custom.config.php',
            //include __DIR__ . '/config/module.test.config.php'
        ];
        foreach ( $configFiles as $file ) {
            $config = \Zend\Stdlib\ArrayUtils::merge ( $config, $file );
        }
        return $config;
        //return include __DIR__ . '/../config/module.config.php';
    }
}
