<?php

namespace App\Models\Users;

use App\Facade\UserFacade;
use Nette\Security;
use Nette\Utils;

class Authenticator implements Security\IAuthenticator
{

	/** @var UserFacade */
	private $userFacade;

	public function __construct(UserFacade $userFacade)
	{
		$this->userFacade = $userFacade;
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

		$user = $this->userFacade->findOneByUsername($username);
		if (!$user) {
			throw new Security\AuthenticationException('User was not found.', self::IDENTITY_NOT_FOUND);
		}

		if (!$user->verifyPassword($password)) {
			throw new Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		}

		$this->rehashWhenNeeded($user, $password);

		return $user;
	}

	private function rehashWhenNeeded(User $user, string $password)
	{
		if ($user->needsRehash()) {
			$user->setPassword($password);
			$this->userFacade->save($user);
		}
	}

}
