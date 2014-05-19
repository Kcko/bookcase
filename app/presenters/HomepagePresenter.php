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
	}
	
	
	/**
	 * @param int
	 */
	public function handleDelete($id)
	{
		$this->books->get($id)->delete();
		$this->redirect('this');
	}

}
