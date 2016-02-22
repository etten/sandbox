<?php

namespace Tests;

use Etten\Sandbox;

class FooTest extends \PHPUnit_Framework_TestCase
{

	public function testGetBar()
	{
		$foo = new Sandbox\Foo();
		$this->assertSame('bar', $foo->getBar());
	}

}
