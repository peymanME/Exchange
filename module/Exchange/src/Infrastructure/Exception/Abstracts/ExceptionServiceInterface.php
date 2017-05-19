<?php
namespace Exchange\Infrastructure\Exception\Abstracts;

interface ExceptionServiceInterface {
	
    public function Invoke_Throw($message);

    public function Invoke_Message(\Exception $e);

    public function Invoke_Stop(\Exception $e);

    public function Invoke_File(\Exception $e);

    public function Invoke_Debuge($message , $exit);
}