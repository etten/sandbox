<?php

namespace Project\Articles;

use Doctrine\ORM;
use Etten\Doctrine\Facade;
use Project\Routes;

class Articles extends Facade
{

	/**
	 * @param Routes\Route $route
	 * @return Article|null
	 */
	public function findOneByRoute(Routes\Route $route)
	{
		return $this->createJoinedQueryBuilder()
			->where('a.route = :route')
			->setParameter('route', $route)
			->getQuery()
			->getOneOrNullResult();
	}

	private function createJoinedQueryBuilder() :ORM\QueryBuilder
	{
		return $this->createQueryBuilder()
			->select('a, ar')
			->from(Article::class, 'a')
			->join('a.route', 'ar');
	}

}
