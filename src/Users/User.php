<?php

namespace Project\Users;

use Doctrine\ORM;
use Etten\Doctrine\Entities\Attributes\Id;
use Etten\Doctrine\Entities\Entity;
use Nette\Security;

/**
 * @ORM\Mapping\Entity()
 */
class User extends Entity implements Security\IIdentity
{

	use Id;

	/**
	 * @var string
	 * @ORM\Mapping\Column(type="string", unique=true)
	 */
	private $username;

	/**
	 * @var string
	 * @ORM\Mapping\Column(type="string", length=60)
	 */
	private $passwordHash;

	public function __construct(string $username, string $password)
	{
		$this->setUsername($username);
		$this->setPassword($password);
	}

	public function getUsername() :string
	{
		return $this->username;
	}

	public function getPasswordHash() :string
	{
		return $this->passwordHash;
	}

	public function setUsername(string $username)
	{
		$this->username = $username;
	}

	public function setPassword(string $passwordHash)
	{
		$this->passwordHash = Security\Passwords::hash($passwordHash);
	}

	public function needsRehash() :bool
	{
		return Security\Passwords::needsRehash($this->getPasswordHash());
	}

	public function verifyPassword(string $password) :bool
	{
		return Security\Passwords::verify($password, $this->getPasswordHash());
	}

	/**
	 * Returns a list of roles that the user is a member of.
	 * @return array
	 */
	public function getRoles() :array
	{
		return [];
	}

}
