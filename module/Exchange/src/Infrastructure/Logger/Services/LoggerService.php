<?php
namespace Exchange\Infrastructure\Logger\Services;

use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

use Exchange\Infrastructure\Logger\Abstracts\LoggerServiceInterface;

class LoggerService  implements LoggerServiceInterface 
{
	/**
	 * EMERG   = 0;  // Emergency: system is unusable
	 * ALERT   = 1;  // Alert: action must be taken immediately
	 * CRIT    = 2;  // Critical: critical conditions
	 * ERR     = 3;  // Error: error conditions
	 * WARN    = 4;  // Warning: warning conditions
	 * NOTICE  = 5;  // Notice: normal but significant condition
	 * INFO    = 6;  // Informational: informational messages
	 * DEBUG   = 7;  // Debug: debug messages
	 */
    private $logger;
  
    public function __construct() {
        
        $logPath = "./data/log";
        $posFixPath = date('Y-m-d').'-logfile.log';
        
        $this->logger = new Logger();        
        if (!file_exists($logPath)) {
            
            mkdir($logPath, 0777, true);
        }

        $stream = fopen($logPath .'/'. $posFixPath , 'a', false);							
        $writer = new Stream($stream);
        $this->logger->addWriter($writer);
    }

    public function info ($message){
        $this->logger->info($message);
    }

    public function recordLog($array){
        $message = '';
                
        foreach ($array as  $node => $value){
            $message .= $node . '(' . $value .') ';
        }	 
        $this->logger->notice($message);
    }
}