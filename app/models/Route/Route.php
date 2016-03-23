<?php

namespace App\Models\Routes;

use Doctrine\ORM;
use Etten\Doctrine\Entities\Attributes\Id;
use Etten\Doctrine\Entities\Entity;
use Nette\Utils\Strings;

/**
 * @ORM\Mapping\Entity()
 */
class Route extends Entity
{

	use Id;

	/**
	 * @var string
	 * @ORM\Mapping\Column(type="string", unique=true)
	 */
	private $url;

	/**
	 * @var string
	 * @ORM\Mapping\Column(type="string")
	 */
	private $type;

	/**
	 * @var string
	 * @ORM\Mapping\Column(type="string")
	 */
	private $title = '';

	/**
	 * @var string
	 * @ORM\Mapping\Column(type="string")
	 */
	private $keywords = '';

	/**
	 * @var string
	 * @ORM\Mapping\Column(type="string")
	 */
	private $description = '';

	public function __construct(string $type)
	{
		$this->type = $type;
	}

	public function __toString()
	{
		return '/' . $this->getUrl();
	}

	/**
	 * @return string
	 */
	public function getUrl():string
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return Route
	 */
	public function setUrl(string $url)
	{
		$this->url = Strings::webalize($url, '/');
		return $this;
	}

	/**
	 * @return string
	 */
	public function getType():string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getTitle():string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return Route
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getKeywords():string
	{
		return $this->keywords;
	}

	/**
	 * @param string $keywords
	 * @return Route
	 */
	public function setKeywords(string $keywords)
	{
		$this->keywords = $keywords;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription():string
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 * @return Route
	 */
	public function setDescription(string $description)
	{
		$this->description = $description;
		return $this;
	}

}
