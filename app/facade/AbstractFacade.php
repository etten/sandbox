<?php

namespace App\Facade;

use Kdyby\Doctrine;

abstract class AbstractFacade
{

	/** @var Doctrine\EntityManager */
	protected $em;

	public function __construct(Doctrine\EntityManager $em)
	{
		$this->em = $em;
	}

	protected function createQueryBuilder():Doctrine\QueryBuilder
	{
		return $this->em->createQueryBuilder();
	}

	protected function getRepository(string $entityName):Doctrine\EntityRepository
	{
		return $this->em->getRepository($entityName);
	}

}
