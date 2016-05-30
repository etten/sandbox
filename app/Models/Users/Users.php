<?php

namespace App\Models\Users;

use Etten\Doctrine\Facade;

class Users extends Facade
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
