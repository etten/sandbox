<?php

namespace Tests\Integration\Articles;

use App\Models\Articles;
use App\Models\Routes;
use Etten\App\Tests\DoctrineTestCase;

class ArticlePersistingTest extends DoctrineTestCase
{

	protected function setUp()
	{
		parent::setUp();
		$this->loadFixture(__DIR__ . '/fixture.sql');
	}

	public function testPersist()
	{
		$article = new Articles\Article();
		$article->setName('The Article');

		$route = new Routes\Route('article');
		$route->setUrl('the-article');

		$article->setRoute($route);

		$this->em->persist($article);
		$this->em->flush();

		$articles = $this->em
			->getRepository(Articles\Article::class)
			->findAll();

		$this->assertCount(1, $articles);
	}

}
