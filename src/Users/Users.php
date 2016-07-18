<?php

namespace Project\Users;

use Etten\Doctrine\Facade;

class Users extends Facade
{

	/**
	 * @param string $username
	 * @return null|object|User
	 */
	public function findOneByUsername(string $username)
	{
		return $this->getRepository(User::class)
			->findOneBy(['username' => $username]);
	}

	/**
	 * @param mixed $id
	 * @return null|object|User
	 */
	public function find($id)
	{
		return $this->getRepository(User::class)
			->find($id);
	}

	public function save(User $user)
	{
		$this->em->persist($user);
		$this->em->flush($user);
	}

}
