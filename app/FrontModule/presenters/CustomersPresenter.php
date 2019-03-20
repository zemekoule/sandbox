<?php declare(strict_types=1);

namespace FrontModule;

use Nette;
use Nette\Application\UI\Form;
use Nette\Forms\Container;
use Nette\Forms\Controls\SubmitButton;
use WebChemistry\Forms\Controls\Submitter;

class CustomersPresenter extends Nette\Application\UI\Presenter {


	/** @var string First claim assistant subform id */
	const FIRST_ITEM_ID = '5b2841b82a8b2';

	protected function createComponentCustomerForm() {

		$copies = 1;
		$maxCopies = 10;

		$form = new BaseForm();
		$form->addText('company', 'Firma');

		//$form->addContainer('subFormRows');
		//$form->addHidden('rowIds')->setDefaultValue(serialize([self::FIRST_ITEM_ID]));

		$multiplierCategories = $form->addMultiplier('categories', function (Nette\Forms\Container $container, Nette\Forms\Form $form) {
			$container->addSelect('categories', 'Kategorie', ['První', 'Druhá', 'Třetí'])
				->setPrompt('Vyberte kategorii')
				->setRequired('Musíte vybrat kategorii');
		}, $copies, $maxCopies);

		$multiplierCategories->addRemoveButton('remove', function (Nette\Forms\Controls\SubmitButton $submitter) {
			$submitter->setHtmlAttribute('class', 'btn btn-danger');
			$submitter->setHtmlAttribute('class', 'ajax');
			$submitter->onClick[] = function () {
				/** @var \Nette\Application\UI\Presenter $presenter */
				$this->redrawControl('customerForm');
			};
		});

		$multiplierCategories->addCreateButton('add',1, function (Submitter $submitter) {
			$submitter->setHtmlAttribute('class', 'btn btn-default');
			$submitter->setHtmlAttribute('class', 'ajax');
			$submitter->onClick[] = function () {
				/** @var \Nette\Application\UI\Presenter $presenter */
				$this->redrawControl('customerForm');
			};
		})->setNoValidate();

		$multiplierNames = $form->addMultiplier('names', function (Nette\Forms\Container $container, Nette\Forms\Form $form) {
			$container->addText('surname', 'Přijmení')
				->setRequired('Vyplňte přijmení');
			$container->addText('firstName', 'Křestní jméno');
		}, $copies, $maxCopies);

		$multiplierNames->addRemoveButton('Odstranit', function (Nette\Forms\Controls\SubmitButton $submitter) {
			$submitter->setHtmlAttribute('class', 'btn btn-danger');
			$submitter->setHtmlAttribute('class', 'ajax');
			$submitter->onClick[] = function () {
				/** @var \Nette\Application\UI\Presenter $presenter */
				$this->redrawControl('customerForm');
			};
		});

		$multiplierNames->addCreateButton('Přidat',1, function (Submitter $submitter) {
			$submitter->setHtmlAttribute('class', 'btn btn-default');
			$submitter->setHtmlAttribute('class', 'ajax');
			$submitter->onClick[] = function () {
				/** @var \Nette\Application\UI\Presenter $presenter */
				$this->redrawControl('customerForm');
			};
		})->setNoValidate();

		$form->addSubmit('send', 'Odeslat');
		$form->onSuccess[] = [$this, 'customerFormSucceeded'];
		return $form;
	}

	/**
	 * @param Form $form
	 * @return void
	 */
	public function addSubFormRows(Form $form): void {
		foreach(unserialize($form['rowIds']->value) as $rowId) {
			$this->addSubFormRow($form, $rowId);
		}
	}

	/**
	 * @param \Nette\Application\UI\Form $form
	 * @param string $rowId
	 *
	 * @return void
	 */
	public function addSubFormRow(Form $form, string $rowId): void {
		/** @var \Nette\Forms\Container $claimAssistantContainer */
		$claimAssistantContainer = $form->getComponent('subFormRows');
		$claimAssistantContainer[$rowId] = $this->createSubFormRow();
	}

	/**
	 * @return Container
	 */
	protected function createSubFormRow(): Container {
		$rowContainer = new Container();
		$rowContainer->addText('email', 'Email');
		$rowContainer->addText('phone', 'Telefon')->setAttribute("placeholder", 'Zadejte telefon');

		return $rowContainer;
	}

	/**
	 * @param \Nette\Forms\Controls\SubmitButton $button
	 * @return void
	 */
	public function doAddsubFormRow(SubmitButton $button): void {
		$form = $button->getForm();
		if($form === NULL) return;

		$newRowId = uniqid();
		$this->addSubFormRow($form, $newRowId);
		$form['rowIds']->value = serialize(array_merge(unserialize($form['rowIds']->value), [$newRowId]));

		if($this->isAjax()) {
			$this->redrawControl();
		}
	}

	/**
	 * @param \Nette\Forms\Controls\SubmitButton $button
	 * @return void
	 */
	public function doRemoveClaimAssistantFormRow(SubmitButton $button): void {
		$form = $button->getForm();
		if($form === NULL) return;

		$rowIds = unserialize($form['rowIds']->value);
		$lastRowId = end($rowIds);

		/** @var \Nette\Forms\Container $claimAssistantContainer */
		$claimAssistantContainer = $form->getComponent('subFormRows');
		unset($claimAssistantContainer[$lastRowId]);
		array_pop($rowIds);
		$form['rowIds']->value = serialize($rowIds);

		if($this->isAjax()) {
			$this->redrawControl();
		}
	}

	/**
	 * @param \Nette\Forms\Controls\SubmitButton $button
	 * @return void
	 * @throws \Nette\Application\AbortException
	 */
	public function doFormPost(SubmitButton $button): void {
		$form = $button->getForm();

		if(!$form->hasErrors()) {
			$this->flashMessage('Hotovo', 'success');
			$this->redirect('this');
		}

		if($this->isAjax()) {
			$this->redrawControl();
		}
	}


	/**
	 * @param \Nette\Application\UI\Form $form
	 *
	 * @throws \Nette\Application\AbortException
	 */
	public function customerFormSucceeded(Form $form) {
		$values = $form->getValues();
		bdump($values);
		$this->redirect('this');
	}
}
