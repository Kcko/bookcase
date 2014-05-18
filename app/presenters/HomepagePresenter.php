<?php

namespace App\Presenters;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$books = [
				'Robert Louis Stevenson' => [
					'Ostrov pokladů',
					'Podivný případ Dr. Jekylla a pana Hyda',
					'Černý šíp',
					'Rytíř z Ballantrae'
					],
				'John Ronald Reuel Tolkien' => [
					'Hobit aneb Cesta tam a zase zpátky',
					'Pán prstenů',
					'Silmarillion'
					]
				];
		
		$this->template->books = $books;
	}

}
