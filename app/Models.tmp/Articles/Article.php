<?php

namespace App\Models\Articles;

use App\Models\Routes\Route;
use Doctrine\ORM;
use Etten\Doctrine\Entities\Attributes\Id;
use Etten\Doctrine\Entities\Entity;

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
	 * @var Route
	 * @ORM\Mapping\OneToOne(targetEntity="\App\Models\Routes\Route", cascade={"persist", "remove"})
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
	 * @return Route
	 */
	public function getRoute():Route
	{
		return $this->route;
	}

	/**
	 * @param Route $route
	 * @return $this
	 */
	public function setRoute(Route $route)
	{
		$this->route = $route;
		return $this;
	}

}
