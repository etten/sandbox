<?php

namespace App\Models\Articles;

use App\Models\Routes\Route;
use Doctrine\ORM;
use Etten\Doctrine\Facade;

class Articles extends Facade
{

	/**
	 * @param Route $route
	 * @return Article|null
	 */
	public function findOneByRoute(Route $route)
	{
		return $this->createJoinedQueryBuilder()
			->where('a.route = :route')
			->setParameter('route', $route)
			->getQuery()
			->getOneOrNullResult();
	}

	private function createJoinedQueryBuilder():ORM\QueryBuilder
	{
		return $this->createQueryBuilder()
			->select('a, ar')
			->from(Article::class, 'a')
			->join('a.route', 'ar');
	}

}
