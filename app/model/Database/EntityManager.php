<?php declare(strict_types=1);

namespace app\model\Database;

use app\model\Database\Entity\User;
use app\model\Database\Repository\UserRepository;
use Nettrine\ORM\EntityManager as NettrineEntityManager;

/**
 * Custom EntityManager
 */
final class EntityManager extends NettrineEntityManager {
	//use TRepositories;

	/**
	 * @return \app\model\Database\Repository\UserRepository|\Doctrine\Common\Persistence\ObjectRepository
	 */
	public function getUserRepository(): UserRepository {
		return $this->getRepository(User::class);
	}
}