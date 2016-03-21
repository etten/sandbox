<?php

namespace App\Models\Articles;

use Doctrine\ORM;
use Etten\Doctrine\Entities\Attributes\Id;
use Etten\Doctrine\Entities\IdProvider;

/**
 * @ORM\Mapping\Entity()
 */
class Article implements IdProvider
{

	use Id;

	/**
	 * @ORM\Mapping\Column(type="string")
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
