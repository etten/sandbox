<?php

namespace App\Router;

use App\Models\Routes;
use Nette\Application;
use Nette\Http;

class RouteRouter implements Application\IRouter
{

	/** @var array */
	private $typeMap = [];

	/** @var array */
	private $presenterMap = [];

	/** @var Routes\Routes */
	private $routes;

	public function __construct(array $map, Routes\Routes $routes)
	{
		$this->typeMap = $map;
		$this->presenterMap = array_flip($this->typeMap);
		$this->routes = $routes;
	}

	/**
	 * Maps HTTP request to a Request object.
	 * @param Http\IRequest $httpRequest
	 * @return Application\Request|NULL
	 */
	public function match(Http\IRequest $httpRequest)
	{
		$url = $httpRequest->getUrl();
		$urlPath = ltrim($url->getPath(), '/');

		$route = $this->safeFindRoute($urlPath);
		if (!$route) {
			return NULL;
		}

		$presenterAction = $this->typeMap[$route->getType()] ?? NULL;
		if (!$presenterAction) {
			return NULL;
		}

		$parts = explode(':', $presenterAction);
		$action = array_pop($parts);
		$presenter = implode(':', $parts);

		$parameters = $httpRequest->getQuery();
		$parameters['action'] = $action;
		$parameters['route'] = $route;

		return new Application\Request(
			$presenter,
			$httpRequest->getMethod(),
			$parameters,
			$httpRequest->getPost(),
			$httpRequest->getFiles(),
			[
				Application\Request::SECURED => $httpRequest->isSecured(),
			]
		);
	}

	/**
	 * Constructs absolute URL from Request object.
	 * @param Application\Request $appRequest
	 * @param Http\Url $refUrl
	 * @return NULL|string
	 */
	public function constructUrl(Application\Request $appRequest, Http\Url $refUrl)
	{
		$route = $appRequest->getParameter('route');

		if ($route && $route instanceof Routes\Route) {
			$parameters = $appRequest->getParameters();

			// unset router-specific parameters
			unset($parameters['action'], $parameters['route']);

			$newUrl = new Http\Url($refUrl->getBaseUrl() . $route->getUrl());
			$newUrl->setQuery($parameters);

			return $newUrl->getAbsoluteUrl();
		}

		return NULL;
	}

	/**
	 * @param string $url
	 * @return Routes\Route|null
	 */
	private function safeFindRoute(string $url)
	{
		try {
			return $this->routes->findOneByUrl($url);
		} catch (\Throwable $e) {
			// Table must not exist or something go wrong...
			return NULL;
		}
	}

}
