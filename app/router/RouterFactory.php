<?php

namespace App\Router;

use Nette;
use Nette\Application\Routers;

class RouterFactory
{

	/** @var RouteRouter */
	private $routeRouter;

	public function __construct(RouteRouter $routeRouter)
	{
		$this->routeRouter = $routeRouter;
	}

	/**
	 * @return Nette\Application\IRouter
	 */
	public function create()
	{
		$router = new Routers\RouteList();

		$router[] = $this->routeRouter;

		$router[] = new Routers\Route('<presenter>/<action>[/<id>]', 'Front:Homepage:default');

		return $router;
	}

}
