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
	 * @return array
	 */
	public function findAll()
	{
		return $this->database->query('
				select book.*, author.name as author
				from book
				join author on book.id_author = author.id
			')->fetchAll();
	}
	
	
	/** 
	 * @param int
	 * @return array
	 */
	public function findByAuthor($idAuthor)
	{
		return $this->database->query('select * from book where id_author = ?', $idAuthor)->fetchAll();
	}
	
	
	/** 
	 * @param string
	 * @return \Nette\Database\Row|FALSE
	 */
	public function getByTitle($title)
	{
		return $this->database->query('select * from book where title = ?', $title)->fetch();
	}
	

}
