<?php
namespace Exchange\Infrastructure\Logger\Abstracts;

interface LoggerServiceInterface {
	
	public function info($message);
	public function recordLog($array);

}