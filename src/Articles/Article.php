<?php

namespace Project\Articles;

use Doctrine\ORM\Mapping as ORM;
use Etten\Doctrine\Entities;
use Project\Routes;

/**
 * @ORM\Entity()
 */
class Article extends Entities\UuidBinaryEntity
{

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name = '';

	/**
	 * @var Routes\Route
	 * @ORM\OneToOne(targetEntity="\Project\Routes\Route", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $route;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}

	public function getRoute(): Routes\Route
	{
		return $this->route;
	}

	public function setRoute(Routes\Route $route)
	{
		$this->route = $route;
	}

}
