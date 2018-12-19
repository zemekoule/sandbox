<?php declare(strict_types=1);

namespace App\Model\Database\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Class UserLoginHistory
 * @ORM\Entity
 */
class UserLoginHistory {

	/**
	 * @var \Ramsey\Uuid\UuidInterface
	 *
	 * @ORM\Id
	 * @ORM\Column(type="uuid", unique=true)
	 * @ORM\GeneratedValue(strategy="CUSTOM")
	 * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
	 */
	protected $id;

	/**
	 * @ManyToOne(targetEntity="User", inversedBy="loginHistories")
	 */
	protected $user;

	/**
	 * @ORM\Column(type="datetime_immutable")
	 * @var \DateTimeImmutable
	 */
	protected $createdAt;

	/**
	 * UserLoginHistory constructor.
	 *
	 * @param \App\Model\Database\Entity\User $user
	 *
	 * @throws \Exception
	 */
	public function __construct(User $user) {
		$this->createdAt = new \DateTimeImmutable();
		$this->user = $user;
	}

	/**
	 * @return \Ramsey\Uuid\UuidInterface
	 */
	public function getId(): \Ramsey\Uuid\UuidInterface {
		return $this->id;
	}



	/**
	 * @return \App\Model\Database\Entity\User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @return \DateTimeImmutable
	 */
	public function getCreatedAt(): \DateTimeImmutable {
		return $this->createdAt;
	}
}
