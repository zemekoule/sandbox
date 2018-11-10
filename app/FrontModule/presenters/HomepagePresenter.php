<?php

namespace FrontModule;

use app\model\Database\Entity\User;
use app\model\Database\EntityManager;
use Nette;
use Doctrine\ORM\EntityRepository as DoctrineEntityRepository;

class HomepagePresenter extends Nette\Application\UI\Presenter {

	/** @var EntityManager @inject */
	public $entityManager;

	/** @var DoctrineEntityRepository @injectRepo */
	public $userRepo;

//	/** @var \app\model\Database\Repository\UserRepository @inject */
//	public $userRepository;

	public function renderDefault() {
		 //$users = $this->entityManager->getUserRepository()->findAll();
		 $this->userRepo = $this->entityManager->getRepository(User::class);
		//$users = $this->userRepository->findAll();
	 	bdump($this->userRepo->findAll());

	}
}
