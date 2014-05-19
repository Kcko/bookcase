<?php

namespace App\Presenters;

use Nette\Database\Context as NDatabase;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	
	/**
	 * @var NDatabase
	 * @inject
	 */
	public $database;
	
	
	public function renderDefault()
	{
	}

	public function renderBookcase()
	{
		$books = $this->database->query('select * from book');
		$this->template->books = $books;
	}

}
