<?php

namespace App\Presenters;

use App\Model\BookRepository,
	App\Model\AuthorRepository;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	
	/**
	 * @var BookRepository
	 * @inject
	 */
	public $books;
	
	/**
	 * @var AuthorRepository
	 * @inject
	 */
	public $authors;
	
	
	public function renderDefault()
	{
	}

	public function renderBookcase()
	{
		$this->template->books = $this->books->findAll();
		$this->template->authors = $this->authors->findAll();
	}

}
