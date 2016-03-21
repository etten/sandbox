<?php

namespace App\Articles;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine;

/**
 * @ORM\Entity()
 */
class Article
{

	use Doctrine\Entities\Attributes\UniversallyUniqueIdentifier;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name = '';

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

}
