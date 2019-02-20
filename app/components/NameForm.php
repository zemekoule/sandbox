<?php declare(strict_types=1);

namespace App\Components;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class NameForm extends Control
{
	public $onCategorySave;

	protected function createComponentNameForm()
	{
		$form = new Form();
		$form->addText('name', 'Jméno:');
		$form->addSubmit('login', 'Registrovat');
		$form->onSuccess[] = [$this, 'processForm'];

		return $form;
	}

	public function processForm(Form $form)
	{

		$this->onCategorySave($this);
	}


	public function render()
	{

		$this->template->render(__DIR__ . '/nameForm.latte');
	}

}