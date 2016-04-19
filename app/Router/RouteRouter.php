<?php

namespace App\Router;

use App\Models\Routes;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Kdyby\Doctrine\EntityManager;
use Nette;
use Nette\Application;

class RouteRouter implements Application\IRouter
{

	/** @var array */
	private $typeMap = [];

	/** @var array */
	private $presenterMap = [];

	/** @var EntityManager */
	private $em;

	public function __construct(array $map, EntityManager $em)
	{
		$this->typeMap = $map;
		$this->presenterMap = array_flip($this->typeMap);
		$this->em = $em;
	}

	/**
	 * Maps HTTP request to a Request object.
	 * @param Nette\Http\IRequest $httpRequest
	 * @return Application\Request|NULL
	 */
	public function match(Nette\Http\IRequest $httpRequest)
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
				Nette\Application\Request::SECURED => $httpRequest->isSecured(),
			]
		);
	}

	/**
	 * Constructs absolute URL from Request object.
	 * @param Application\Request $appRequest
	 * @param Nette\Http\Url $refUrl
	 * @return NULL|string
	 */
	public function constructUrl(Application\Request $appRequest, Nette\Http\Url $refUrl)
	{
		$route = $appRequest->getParameter('route');

		if ($route && $route instanceof Routes\Route) {
			$parameters = $appRequest->getParameters();

			// unset router-specific parameters
			unset($parameters['action'], $parameters['route']);

			$newUrl = new Nette\Http\Url($refUrl->getBaseUrl() . $route->getUrl());
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
		$repository = $this->em->getRepository(Routes\Route::class);

		try {
			return $repository->findOneBy(['url' => $url]);
		} catch (TableNotFoundException $e) {
			return NULL;
		}
	}

}
