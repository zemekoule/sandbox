<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

use Ramsey\Uuid\UuidInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Role {

	/**
	 * @var \Ramsey\Uuid\UuidInterface
	 *
	 * @ORM\Id
	 * @ORM\Column(type="uuid", unique=true)
	 * @ORM\GeneratedValue(strategy="CUSTOM")
	 * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
	 */

	private $id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;


	public function __construct(string $name) {

		$this->setName($name);
	}

	public function getId(): UuidInterface {
		return $this->id;
	}

	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void {
		$this->name = $name;
	}

}
