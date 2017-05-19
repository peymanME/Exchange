<?php
namespace Exchange\Services\Abstracts\Interfaces;

interface AuthServiceInterface {
    public function is_Authenticate();
    public function getUserName();
    public function getUserObj();
    public function authClean();
    public function login($dataFormArray);    
}