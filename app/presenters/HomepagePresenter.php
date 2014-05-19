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
		$this->template->books = $this->bookcase->findAllBooks();
	}

}
