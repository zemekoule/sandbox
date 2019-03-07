<?php declare(strict_types=1);

namespace App\Grids;

use App\Model\Database\Entity\User;
use Doctrine\ORM\EntityManager;
use Ublaboo\DataGrid\DataGrid;

class UserGrid extends \Nette\Application\UI\Control {

	/** @var EntityManager */
	private $entityManager;

	public function __construct(EntityManager $entityManager) {
		 parent::__construct();
		$this->entityManager = $entityManager;
	}

	public function render() {
		$this->template->render(__DIR__ . '/userGrid.latte');
	}

	public function createComponentUserGrid($name) {
		$grid = new DataGrid($this, $name);

		$users = $this->entityManager->createQueryBuilder()
			->select('u')
			->from(User::class, 'u');

		$grid->setDataSource($users);
		$grid->setOuterFilterRendering(true);
		$grid->setStrictSessionFilterValues(false);
		$grid->setDefaultSort(['name' => 'ASC']);
		//$grid->setAutoSubmit(false);
		$grid->setRememberState(false);

		$grid->addColumnText('name', 'Jméno')
			->setSortable()
			->setFilterText('name');

		$grid->addColumnText('lastLogin', 'Posl.přihlášení');
	}
}
