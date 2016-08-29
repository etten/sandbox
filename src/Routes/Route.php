<?php

namespace Project\Routes;

use Doctrine\ORM\Mapping as ORM;
use Etten\Doctrine\Entities;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *     name="route",
 *     indexes={
 *     @ORM\Index(columns={"type"})
 *     }
 * )
 */
class Route extends Entities\UuidBinaryEntity
{

	/**
	 * @var string
	 * @ORM\Column(type="string", unique=true)
	 */
	private $url;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $type;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $title = '';

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $keywords = '';

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $description = '';

	public function __construct(string $type)
	{
		$this->generateId();
		$this->type = $type;
	}

	public function getPath(): string
	{
		return '/' . $this->getUrl();
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function setUrl(string $url)
	{
		$this->url = RouteHelpers::webalize($url, '/.');
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title)
	{
		$this->title = $title;
	}

	public function getKeywords(): string
	{
		return $this->keywords;
	}

	public function setKeywords(string $keywords)
	{
		$this->keywords = $keywords;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $description)
	{
		$this->description = $description;
	}

}
