<?php declare(strict_types=1);

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixtures implements FixtureInterface
{
	/**
	 * Load data fixtures with the passed ObjectManager
	 *
	 * @param ObjectManager $manager
	 * @return void
	 */
	public function load(ObjectManager $manager)
	{
		$users = [
			'Gerttruda',

		];

		foreach ($users as $user) {
			$userEntity = new \App\Model\Database\Entity\User($user);
			$manager->persist($userEntity);
			$manager->flush();
		}
	}
}
