<?php

namespace Tests;

use App;
use Etten;
use Nette;

class HomepagePresenterTest extends Etten\App\Tests\PresenterTestCase
{

	protected function getPresenterName():string
	{
		return 'Homepage';
	}

	public function testHandleDelete()
	{
		$this->expectException(Nette\Application\BadRequestException::class);
		$this->runSignal('delete');
	}

	public function testRenderDefault()
	{
		$response = $this->runAction();
		$this->assertInstanceOf(Nette\Application\Responses\TextResponse::class, $response);
	}

}
