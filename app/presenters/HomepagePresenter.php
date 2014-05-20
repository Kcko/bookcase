<?php

namespace App\Presenters;

use App\Model\BookRepository,
	App\Model\AuthorRepository,
    Nette\Application\UI\Form;


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
	
	
	/**
	 * @param int
	 */
	public function handleChangeAuthor($id)
	{
		$book = $this->books->get($id);
		
		$authorId = $book->author->id;
		$secondAuthorId = $authorId === 1 ? 2 : 1;
		
		$book->update(['id_author' => $secondAuthorId]);
		$this->redirect('this');
	}
	
	
	/**
	 * Formulář pro zadání nové knihy.
	 * @return Form
	 */
	protected function createComponentNewBookForm()
	{
		$form = new Form;
		$form->addText('title', 'Název knihy')
			->setRequired('Vyplňte název knihy.');
		$form->addSelect('id_author', 'Autor', $this->authors->findAll()->fetchPairs('id', 'name'))
			->setRequired('Vyberte autora knihy.');
		$form->addSubmit('ok', 'Odeslat');
		$form->onSuccess[] = $this->newBookFormSuccess;

		return $form;
	}


	/**
	 * Zpracování formuláře pro zadání nové knihy.
	 * @param Form $form
	 */
	public function newBookFormSuccess($form)
	{
		$values = $form->getValues();
		$this->books->insert($values);
		$this->redirect('this');
	}

}
