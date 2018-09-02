<?php declare(strict_types=1);

namespace AdminModule;

use Nette\Application\UI\Presenter;

class SignPresenter extends Presenter {

	/**
	 * @throws \Nette\Application\AbortException
	 */
	public function actionOut(): void {
		$this->getUser()->logout();
		$this->flashMessage('Odhlášení bylo úspěšné.');
		$this->redirect('Homepage:');
	}
}