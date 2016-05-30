<?php

namespace App\Facade;

use App\Models\Articles;
use App\Models\Routes\Route;
use Doctrine\ORM;

class ArticleFacade extends Facade
{

	/**
	 * @param Route $route
	 * @return Articles\Article|null
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
			->from(Articles\Article::class, 'a')
			->join('a.route', 'ar');
	}

}
