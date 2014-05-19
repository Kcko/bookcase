<?php

namespace App\Model;

use Nette\Object,
	Nette\Database\Context as NDatabase;


/**
 * Repozitář pro práci s tabulkou 'book'.
 */
class BookRepository extends Object
{

	/** @var NDatabase */
	private $database;


	public function __construct(NDatabase $database)
	{
		$this->database = $database;
	}

	
	/** 
	 * Vrátí všechny platné záznamy
	 * 
	 * @return \Nette\Database\Table\Selection
	 */
	public function findAll()
	{
		return $this->database->table('book');
	}
	
	
	/** 
	 * Vrátí kolekci záznamů podle podmínky
	 * 
	 * @param array
	 * @return \Nette\Database\Table\Selection
	 */
	public function findBy($where)
	{
		return $this->findAll()->where($where);
	}
	
	
	/** 
	 * Vrátí jeden záznam podle podmínky
	 * 
	 * @param array
	 * @return \Nette\Database\Table\ActiveRow|FALSE
	 */
	public function getBy($where)
	{
		return $this->findAll()->where($where)->fetch();
	}
	

}
