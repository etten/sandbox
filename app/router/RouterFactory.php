<?php

namespace App;

use Nette;
use Nette\Application\Routers;

class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public function create()
	{
		$router = new Routers\RouteList();
		$router[] = new Routers\Route('<presenter>/<action>[/<id>]', 'Homepage:default');

		return $router;
	}

}
