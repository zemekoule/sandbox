<?php declare(strict_types = 1);

namespace App\Components;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class CommentFormControl extends Control
{
	private $successCallback;

	public function __construct(callable $successCallback)
	{
		parent::__construct();

		$this->successCallback = $successCallback;

	}
	protected function createComponentForm()
	{
		$form = new Form();
		$form->addText('name', 'Your name:')
			->setRequired();
		$form->addEmail('email', 'Email:');
		$form->addTextArea('content', 'Comment:')
			->setRequired();
		$form->addSubmit('send', 'Publish comment');
		$form->onSuccess[] = [$this, 'processForm'];
		return $form;
	}
	public function processForm($form, $values)
	{

		($this->successCallback)($this);
	}
	public function render()
	{
		$this['form']->render();
	}

}