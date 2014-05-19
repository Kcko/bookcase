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
	 * @return array
	 */
	public function findAll()
	{
		return $this->database->query('select * from author')->fetchAll();
	}
	
	
	/** 
	 * @param string
	 * @return \Nette\Database\Row|FALSE
	 */
	public function getByName($name)
	{
		return $this->database->query('select * from author where name = ?', $name)->fetch();
	}
	

}
