<?php

namespace App\Presenters;

use App\Model\BookRepository,
	App\Model\AuthorRepository,
    Nette\Application\UI\Form,
	Nette\Forms\Controls;


/**
 * Bookcase presenter.
 */
final class BookcasePresenter extends BasePresenter
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
	
	
	
	public function renderList()
	{
		$this->template->books = $this->books->findAll();
	}
	
	
	/**
	 * @param int
	 */
	public function actionEdit($id)
	{
		$book = $this->books->get($id);
		$this['bookForm']->setDefaults($book);
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
	 * Formulář pro vytvoření, nebo editaci knihy.
	 * @return Form
	 */
	protected function createComponentBookForm()
	{
		$form = new Form;
		
		$form->addHidden('id');
		$form->addText('title', 'Název knihy')
			->setRequired('Vyplňte název knihy.');
		$form->addSelect('id_author', 'Autor', $this->authors->findAll()->fetchPairs('id', 'name'))
			->setRequired('Vyberte autora knihy.');
		$form->addSubmit('ok', 'Odeslat');
		
		$form->onSuccess[] = $this->bookFormSuccess;
		
		// setup form rendering
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = NULL;
		$renderer->wrappers['pair']['container'] = 'div class=form-group';
		$renderer->wrappers['pair']['.error'] = 'has-error';
		$renderer->wrappers['control']['container'] = 'div class=col-sm-9';
		$renderer->wrappers['label']['container'] = 'div class="col-sm-2 control-label"';
		$renderer->wrappers['control']['description'] = 'span class=help-block';
		$renderer->wrappers['control']['errorcontainer'] = 'span class=help-block';

		// make form and controls compatible with Twitter Bootstrap
		$form->getElementPrototype()->class('form-horizontal');

		foreach ($form->getControls() as $control) {
			if ($control instanceof Controls\Button) {
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
				$usedPrimary = TRUE;

			} elseif ($control instanceof Controls\TextBase || $control instanceof Controls\SelectBox || $control instanceof Controls\MultiSelectBox) {
				$control->getControlPrototype()->addClass('form-control');

			} elseif ($control instanceof Controls\Checkbox || $control instanceof Controls\CheckboxList || $control instanceof Controls\RadioList) {
				$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
			}
		}

		return $form;
	}


	/**
	 * Zpracování formuláře pro vytvoření, nebo editaci knihy.
	 * @param Form $form
	 */
	public function bookFormSuccess($form)
	{
		$values = $form->getValues();
		
		if(empty($values->id)) {
			$this->books->insert($values);
		}
		else {
			$book = $this->books->get($values->id);
			$book->update($values);
		}
		
		$this->redirect('list');
	}


}
