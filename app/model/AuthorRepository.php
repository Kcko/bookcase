<?php

namespace App\Model;

use Nette\Object,
	Nette\Database\Context as NDatabase;


/**
 * Repozitář pro práci s tabulkou 'author'.
 */
class AuthorRepository extends Object
{

	/** @var NDatabase */
	private $database;


	public function __construct(NDatabase $database)
	{
		$this->database = $database;
	}

	
	/** 
	 * @return \Nette\Database\Table\Selection
	 */
	public function findAll()
	{
		return $this->database->table('author');
	}
	
	
	/** 
	 * @param string
	 * @return \Nette\Database\Table\ActiveRow|FALSE
	 */
	public function getByName($name)
	{
		return $this->findAll()->where(['name' => $name])->fetch();
	}
	

}
