<?php declare(strict_types=1);

namespace App\Components;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class NameForm extends Control
{
	public $onCategorySave;

	protected function createComponentNameForm(callable $onSuccess)
	{
		$form = new Form();
		$form->addText('name', 'Jméno:');
		$form->addSubmit('login', 'Registrovat');
		$form->onSuccess[] = function(Form $form, $values) use ($onSuccess): void {

			bdump($values, 'Něco z formuláře');
			$onSuccess();
		};

		return $form;
	}

	public function render()
	{

		$this->template->render(__DIR__ . '/nameForm.latte');
	}

}