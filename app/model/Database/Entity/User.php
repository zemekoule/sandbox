<?php declare(strict_types = 1);

namespace app\model\Database\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/**
 * @ORM\Entity
 */
// * @ORM\Entity(repositoryClass="app\model\Database\Repository\UserRepository")
class User {

	use Id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;
}