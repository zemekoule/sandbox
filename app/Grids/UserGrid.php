<?php declare(strict_types=1);

namespace App\Grids;

use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserLoginHistory;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use Ramsey\Uuid\Uuid;
use Ublaboo\DataGrid\DataGrid;

class UserGrid extends \Nette\Application\UI\Control {

	/** @var EntityManager */
	private $entityManager;

	public function __construct(EntityManager $entityManager, EntityManager $d) {
		 parent::__construct();
		$this->entityManager = $entityManager;
	}

	public function render() {
		$this->template->render(__DIR__ . '/userGrid.latte');
	}

	public function createComponentUserGrid($name) {
		$grid = new DataGrid($this, $name);


//		$users = $this->entityManager->createQueryBuilder()
//			->select('u')
//			->addSelect('(SELECT h.createdAt
//            FROM \App\Model\Database\Entity\UserLoginHistory h
//            WHERE h.user = u
//            ORDER BY h.createdAt DESC
//            LIMIT 1) AS lastLogin2' // bohuzel Doctrine nepodporuje LIMIT
//			)
//			->from(User::class, 'u');

		//array_map()

		$users = $this->entityManager->createQueryBuilder()
			->select('u', 'h')
			->from(User::class, 'u')
			->leftJoin('u.loginHistories', 'h')
			->orderBy('u.id', Criteria::ASC)
			->addOrderBy('h.createdAt', Criteria::DESC);

//		$users = $this->entityManager->createQueryBuilder()
//			->select('u', 'MAX(h.createdAt) AS lastLogin2')
//			->from(User::class, 'u')
//			->leftJoin('u.loginHistories', 'h');


		$grid->setDataSource($users);
		$grid->setOuterFilterRendering(true);
		$grid->setStrictSessionFilterValues(false);
//		$grid->setDefaultSort(['name' => 'ASC']);
		$grid->setDefaultSort(['u.name' => 'ASC']);
		//$grid->setAutoSubmit(false);
		$grid->setRememberState(false);

		$grid->addColumnText('name', 'Jméno')
			->setSortable('u.name')
			->setFilterText('name');

		$grid->addColumnText('lastLogin', 'Posl.přihlášení');
//			->setSortable();
	}
}
