<?php

namespace Project\Articles;

use Doctrine\ORM;
use Etten\Doctrine\Entities\Attributes\Id;
use Etten\Doctrine\Entities\Entity;
use Project\Routes;

/**
 * @ORM\Mapping\Entity()
 */
class Article extends Entity
{

	use Id;

	/**
	 * @ORM\Mapping\Column(type="string")
	 * @var string
	 */
	private $name = '';

	/**
	 * @var Routes\Route
	 * @ORM\Mapping\OneToOne(targetEntity="\Project\Routes\Route", cascade={"persist", "remove"})
	 * @ORM\Mapping\JoinColumn(nullable=false)
	 */
	private $route;

	/**
	 * @return string
	 */
	public function getName():string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return $this
	 */
	public function setName(string $name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return Routes\Route
	 */
	public function getRoute():Routes\Route
	{
		return $this->route;
	}

	/**
	 * @param Routes\Route $route
	 * @return $this
	 */
	public function setRoute(Routes\Route $route)
	{
		$this->route = $route;
		return $this;
	}

}
