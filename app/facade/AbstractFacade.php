<?php

namespace App\Facade;

use Doctrine\ORM;

abstract class AbstractFacade
{

	/** @var ORM\EntityManager */
	protected $em;

	public function __construct(ORM\EntityManager $em)
	{
		$this->em = $em;
	}

	protected function createQueryBuilder():ORM\QueryBuilder
	{
		return $this->em->createQueryBuilder();
	}

	protected function getRepository(string $entityName):ORM\EntityRepository
	{
		return $this->em->getRepository($entityName);
	}

}
