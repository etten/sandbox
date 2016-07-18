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
		$router[] = $this->createAdmin();
		$router[] = $this->createFront();

		return $router;
	}

	private function createAdmin()
	{
		$route = new Routers\RouteList('Admin');
		$route[] = new Routers\Route('admin/<presenter>/<action>[/<id>]', 'Dashboard:default');

		return $route;
	}

	private function createFront()
	{
		$route = new Routers\RouteList('Front');
		$route[] = new Routers\Route('<presenter>/<action>[/<id>]', 'Homepage:default');

		return $route;
	}

}
