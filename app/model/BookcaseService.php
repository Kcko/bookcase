<?php

namespace App\Model;

use Nette\Object,
	App\Model\BookRepository,
	App\Model\AuthorRepository;


/**
 * Služba pro práci s repozitáři BookRepository a AuthorRepository.
 */
class BookcaseService extends Object
{

	/** @var BookRepository */
	private $books;
	
	/** @var AuthorRepository */
	private $authors;


	public function __construct(BookRepository $books, AuthorRepository $authors)
	{
		$this->books = $books;
		$this->authors = $authors;
	}
	
	
	/** 
	 * @return array
	 */
	public function findAllAuthors()
	{
		return $this->authors->findAll();
	}
	
	
	/** 
	 * @param string
	 * @return \Nette\Database\Row|FALSE
	 */
	public function getAuthorByName($name)
	{
		return $this->authors->getByName($name);
	}
	

	
	/** 
	 * @return array
	 */
	public function findAllBooks()
	{
		return $this->books->findAll();
	}
	
	
	/** 
	 * @param string
	 * @return array
	 */
	public function findBooksByAuthor($name)
	{
		$author = $this->authors->getByName($name);
		return $this->books->findByAuthor($author->id);
	}
	
	
	/** 
	 * @param string
	 * @return \Nette\Database\Row|FALSE
	 */
	public function getBookByTitle($title)
	{
		return $this->books->getByTitle($title);
	}
	

}