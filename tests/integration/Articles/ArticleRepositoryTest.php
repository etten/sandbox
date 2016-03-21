<?php

namespace Tests\Articles;

use App\Models\Articles;
use Etten\App\Tests\DoctrineTestCase;

class ArticleRepositoryTest extends DoctrineTestCase
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

		$this->em->persist($article);
		$this->em->flush();

		$articles = $this->em
			->getRepository(Articles\Article::class)
			->findAll();

		$this->assertCount(1, $articles);
	}

}
