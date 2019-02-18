<?php

namespace FrontModule;

use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserLoginHistory;
use App\Model\Database\EntityManager;
use Nette;
use Nette\Application\UI\Form;

class HomepagePresenter extends Nette\Application\UI\Presenter {

	/** @var \App\Components\IHelloWorld @inject */
	public $helloWorldFactory;

	/** @var EntityManager @inject */
	public $entityManager;

	/**
	 * @var \App\Grids\IUserGridFactory
	 * @inject
	 */
	public $userGridFactory;

	/**
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 * @throws \Exception
	 */
	public function renderDefault() {

		/** @var User $user */
//	 	$user = $this->entityManager->getRepository(User::class)->findOneBy(['name' => 'Jarda']);
//
//	 	$userLoginHistory = new UserLoginHistory($user);
//		$this->entityManager->persist($userLoginHistory);
//		$this->entityManager->flush();

//		$user = new User('Jana');
//		$this->entityManager->persist($user);
//		$this->entityManager->flush();
	}

	public function createComponentUserGrid() {
		return $this->userGridFactory->create();
	}

	/**
	 * @return \App\Components\HelloWorld
	 */
	protected function createComponentHelloWorld()
	{
		return $this->helloWorldFactory->create();
	}

	protected function createComponentNameForm()
	{
		$form = new Form();
		$form->addText('name', 'Jméno:');
		$form->addSubmit('login', 'Registrovat');
		$form->onSuccess[] = [$this, 'registrationNameFormSucceeded'];

		return $form;
	}

	// volá se po úspěšném odeslání formuláře

	/**
	 * @param \Nette\Application\UI\Form $form
	 *
	 * @throws \Nette\Application\AbortException
	 */
	public function registrationNameFormSucceeded(Form $form)
	{
		$values = $form->getValues();
		$this->flashMessage('Tvoje jméno bylo odesláno!');
		$this->redirect('Homepage:');
	}

}
