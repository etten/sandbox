<?php

namespace App\Facade;

use App\Models\Users\User;

class UserFacade extends AbstractFacade
{

	/**
	 * @param string $username
	 * @return null|User
	 */
	public function findOneByUsername(string $username)
	{
		return $this->getRepository(User::class)
			->findOneBy(['username' => $username]);
	}

	public function save(User $user)
	{
		$this->em->persist($user);
		$this->em->flush($user);
	}

}
