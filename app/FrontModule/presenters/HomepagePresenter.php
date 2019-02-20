<?php

namespace FrontModule;

use App\Model\Database\Entity\Group;
use App\Model\Database\Entity\User;
use App\Model\Database\EntityManager;
use Doctrine\DBAL\LockMode;
use Nette;

/**
 * @property-read
 */
class HomepagePresenter extends Nette\Application\UI\Presenter {

	/** @var EntityManager @inject */
	public $entityManager;

	/** @var \App\Grids\IUserGridFactory @inject */
	public $userGridFactory;

	/** @var string */
	private $novej;

	private $aaa;


//	public function __construct(string $ahoj, array $pico, int $cau, string $novej, $aaa) {
//		$this->ahoj = $ahoj;
//		$ahoj = new MojeTrida;
//		$this->novej = $novej;
//		$this->aaa = $aaa;
//	}


	/**
	 * @throws \Doctrine\ORM\ORMException
	 */
	public function actionDefault() {
		$codeReset = Nette\Utils\Random::generate(10, 'A-Za-z');
		/** @var User $user */
		$user = $this->entityManager->getRepository(User::class)->findOneBy(['name' => 'Jarda']);
		$entityId = $user->getId();
		//$users = $this->entityManager->find(User::class, $entityId, LockMode::OPTIMISTIC, 0);
		//$user->setCodeReset($codeReset);
		//$this->entityManager->persist($user);
		//$this->entityManager->flush();

		//dump($users);
	}

	/**
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 * @throws \Exception
	 */
	public function renderDefault() {

		//$this['loginForm']->setDefaults([]);



		/** @var User $user */
	 	//$user = $this->entityManager->getRepository(User::class)->findOneBy(['name' => 'Jarda']);

	 	/** @var Group $group */
	 	//$group = $this->entityManager->getRepository(Group::class)->findOneBy(['name' => 'Frajeři']);

//		$user->getGroups()->add($group);
//	 	$this->entityManager->persist($user);
//	 	$this->entityManager->flush();

//	 	/** @var User $buddy */
//	 	$buddy = $this->entityManager->getRepository(User::class)->findOneBy(['name' => 'Jana']);

//	 	$user->addBuddy($buddy);
	 	//dump($user->getGroups()->toArray());
	 	//dump($group->getMembers()->toArray());


//	 	$this->entityManager->persist($user);
//	 	$this->entityManager->flush();

//	 	$role = $this->entityManager->getRepository(Role::class)->findOneBy(['name' => 'Admin']);
//
//	 	$user->getRoles()->add($role);
//	 	$this->entityManager->persist($user);
//	 	$this->entityManager->flush();

//		bdump($user->getRoles()->toArray());

//	 	$userLoginHistory = new UserLoginHistory($user);
//		$this->entityManager->persist($userLoginHistory);
//		$this->entityManager->flush();

//		$user = new User('Jana');
//		$this->entityManager->persist($user);
//		$this->entityManager->flush();

//		$user = new Role('Accounting');
//		$this->entityManager->persist($user);
//		$this->entityManager->flush();
	}

	public function createComponentUserGrid() {
		return $this->userGridFactory->create();
	}
}
