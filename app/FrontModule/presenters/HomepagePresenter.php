<?php

namespace FrontModule;

use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserLoginHistory;
use App\Model\Database\EntityManager;
use Nette;

class HomepagePresenter extends Nette\Application\UI\Presenter {

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
}
