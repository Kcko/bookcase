<?php

namespace App\Presenters;

use App\Model\BookcaseService;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	
	/**
	 * @var BookcaseService
	 * @inject
	 */
	public $bookcase;
	
	
	public function renderDefault()
	{
	}

	public function renderBookcase()
	{
		$this->template->booksOfTolkien = $this->bookcase->findBooksByAuthor('John Ronald Reuel Tolkien');
	}

}
