<?php declare(strict_types=1);

namespace AdminModule;

use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter {

	/**
	 * @throws \Nette\Application\AbortException
	 */
	public function startup(): void {
		parent::startup();

		if($this->getUser()->isLoggedIn()) {
			return;
		}

		$this->redirect('Sign:in', ['backlink' => $this->storeRequest()]);

	}
}
