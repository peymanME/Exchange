<?php
namespace Exchange\Models\ViewModels\Base;


class ViewModelBase 
{
    protected $ErrorMessage;
        public function setErrorMessage($errorMessage){
            $this->ErrorMessage = $errorMessage;
            return $this;
        }
        public function getErrorMessage(){
            return $this->ErrorMessage;
        }

    protected $State;
	public function setState($state){
            $this->State = $state;
            return $this;
	}
	public function getState(){
		return $this->State;
	}

    protected $Paginator;
	public function setPaginator($paginator){
            $this->Paginator = $paginator;
            return $this;
	}
	public function getPaginator(){
            return $this->Paginator;
	}

    protected $Form;
	public function setForm($form){
            $this->Form = $form;
            return $this;
	}
	public function getForm(){
            return $this->Form;
	}
	
    protected $ListOf;
	public function setListOf($listOf){
            $this->ListOf = $listOf;
            return $this;
	}
	public function getListOf(){
            return $this->ListOf;
	}
	
}


