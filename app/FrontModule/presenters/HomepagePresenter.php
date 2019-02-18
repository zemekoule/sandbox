<?php

namespace FrontModule;

use App\Components\NameForm;
use App\Model\Database\Entity\User;
use App\Model\Database\EntityManager;
use Nette;

class HomepagePresenter extends Nette\Application\UI\Presenter {

	/** @var \App\Components\IHelloWorld @inject */
	public $helloWorldFactory;

	/** @var \App\Components\INameFormFactory @inject */
	public $nameFormFactory;

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
		$control = $this->nameFormFactory->create();
		$control->onCategorySave[] = function () {
			$this->flashMessage('Tvoje jméno bylo odesláno!');
			$this->redirect('Homepage:');
		};

		return $control;
	}

}
