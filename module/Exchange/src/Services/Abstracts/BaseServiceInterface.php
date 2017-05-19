<?php
namespace Exchange\Services\Abstracts;

interface BaseServiceInterface {
	public function find($entity, $id);
	public function findBy($entity, $array);
	public function save($entity);
	public function listOf($page);
	public function listOfNoPage($entity);
	public function delete($id);
}