<?php

namespace Project\Routes;

use Doctrine\ORM;
use Etten\Doctrine\Entities\Attributes\Id;
use Etten\Doctrine\Entities\Entity;

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

	public function getPath() :string
	{
		return '/' . $this->getUrl();
	}

	/**
	 * @return string
	 */
	public function getUrl() :string
	{
		return $this->url;
	}

	public function setUrl(string $url)
	{
		$this->url = RouteHelpers::webalize($url, '/.');
	}

	public function getType() :string
	{
		return $this->type;
	}

	public function getTitle() :string
	{
		return $this->title;
	}

	public function setTitle(string $title)
	{
		$this->title = $title;
	}

	public function getKeywords() :string
	{
		return $this->keywords;
	}

	public function setKeywords(string $keywords)
	{
		$this->keywords = $keywords;
	}

	public function getDescription() :string
	{
		return $this->description;
	}

	public function setDescription(string $description)
	{
		$this->description = $description;
	}

}
