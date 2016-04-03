<?php

namespace App\Router;

use Nette;
use Nette\Application\Routers;

class RouterFactory
{

	/** @var RouteRouter */
	private $routeRouter;

	/** @var int */
	private $flags = 0;

	public function __construct(bool $secured, RouteRouter $routeRouter)
	{
		if ($secured) {
			$this->flags |= Nette\Application\IRouter::SECURED;
		}

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
		$route[] = new Routers\Route('admin/<presenter>/<action>[/<id>]', 'Dashboard:default', $this->flags);

		return $route;
	}

	private function createFront()
	{
		$route = new Routers\RouteList('Front');
		$route[] = new Routers\Route('<presenter>/<action>[/<id>]', 'Homepage:default', $this->flags);

		return $route;
	}

}
