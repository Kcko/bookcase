<?php

namespace App\Presenters;

use App\Model\BookRepository;


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
	
	
	public function renderDefault()
	{
	}

	public function renderBookcase()
	{
		barDump($this->books->getByTitle('Silmarillion')); # ukázka ladicího výpisu do debug baru
		$books = $this->books->findAll();
		$this->template->books = $books;
	}

}
