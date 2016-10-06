<?php

/**
 * This file is part of etten/sandbox.
 * Copyright © 2016 Jaroslav Hranička <hranicka@outlook.com>
 */

namespace Project\Routes;

use Etten\Doctrine\Facade;

class Routes extends Facade
{

	/**
	 * @param string $url
	 * @return null|object|Route
	 */
	public function findOneByUrl(string $url)
	{
		return $this->getRepository(Route::class)
			->findOneBy(['urlHash' => RouteHelpers::hash($url)]);
	}

}
