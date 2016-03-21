<?php

namespace App\Models\Users;

use Kdyby\Doctrine\EntityManager;
use Nette\Security;
use Nette\Utils;

class Authenticator implements Security\IAuthenticator
{

	/** @var EntityManager */
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Performs an authentication against e.g. database.
	 * and returns IIdentity on success or throws AuthenticationException
	 * @param array $credentials
	 * @return Security\IIdentity
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		$user = $this->findUser($username);
		if (!$user) {
			throw new Security\AuthenticationException('User was not found.', self::IDENTITY_NOT_FOUND);
		}

		if (!$user->verifyPassword($password)) {
			throw new Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		}

		$this->rehash($user, $password);

		return $user;
	}

	/**
	 * @param string $username
	 * @return User|null
	 */
	private function findUser(string $username)
	{
		$repository = $this->em->getRepository(User::class);
		return $repository->findOneBy(['username' => $username]);
	}

	private function rehash(User $user, string $password)
	{
		if ($user->needsRehash()) {
			$user->setPassword($password);
			$this->em
				->persist($user)
				->flush($user);
		}
	}

}
