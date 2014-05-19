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
	 * @return \Nette\Database\Table\Selection
	 */
	public function findAll()
	{
		return $this->database->table('book');
	}
	
	
	/** 
	 * @param int
	 * @return \Nette\Database\Table\Selection
	 */
	public function findByAuthor($idAuthor)
	{
		return $this->findAll()->where(['id_author' => $idAuthor]);
	}
	
	
	/** 
	 * @param string
	 * @return \Nette\Database\Table\ActiveRow|FALSE
	 */
	public function getByTitle($title)
	{
		return $this->findAll()->where(['title' => $title])->fetch();
	}
	

}
