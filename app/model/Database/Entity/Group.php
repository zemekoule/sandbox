<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

use Nettrine\ORM\Entity\Attributes\Id;
use Ramsey\Uuid\UuidInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="`group`")
 */
class Group {
	use Id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
	 * @var \Doctrine\ORM\PersistentCollection
	 */
	private $members;


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

	/**
	 * @return \Doctrine\ORM\PersistentCollection
	 */
	public function getMembers(): \Doctrine\ORM\PersistentCollection {
		return $this->members;
	}


}
