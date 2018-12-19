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
// * @ORM\Entity(repositoryClass="app\model\Database\Repository\UserRepository")
class User {

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

	/**
	 * @OneToMany(targetEntity="UserLoginHistory", mappedBy="user")
	 * @var \Doctrine\ORM\PersistentCollection
	 */
	protected $loginHistories;

	/**
	 * @ORM\ManyToMany(targetEntity="Role")
	 * @var \Doctrine\ORM\PersistentCollection
	 */
	protected $roles;

	/**
	 * @ORM\ManyToMany(targetEntity="User")
	 * @var \Doctrine\ORM\PersistentCollection
	 */
	protected $buddies;


	/**
	 * @ORM\ManyToMany(targetEntity="Group", inversedBy="members")
	 * @var \Doctrine\ORM\PersistentCollection
	 */
	private $groups;

	public function __construct(string $name) {

		$this->setName($name);
	}

	public function getId(): UuidInterface {
		return $this->id;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getLastLogin(): ?string {
		if(!$this->loginHistories) {
			return null;
		}

//		bdump($this->loginHistories);

		$s = $this->loginHistories->first();
		return ($s ? $s->getCreatedAt()->format('d.m.y H:i') : null);


//		$criteria = Criteria::create();
//		$criteria->orderBy(['createdAt' => Criteria::DESC])->setMaxResults(1);
//
//		$s = $this->loginHistories->matching($criteria)->first();
//
//		return ($s ? $s->getCreatedAt()->format('d.m.y H:i') : null);
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
	public function getRoles(): \Doctrine\ORM\PersistentCollection {
		return $this->roles;
	}

	public function addBuddy(User $buddy) {
		return $this->buddies->add($buddy);
	}

	/**
	 * @return \Doctrine\ORM\PersistentCollection
	 */
	public function getBuddies(): \Doctrine\ORM\PersistentCollection {
		return $this->buddies;
	}

	/**
	 * @return \Doctrine\ORM\PersistentCollection
	 */
	public function getGroups(): \Doctrine\ORM\PersistentCollection {
		return $this->groups;
	}



}
