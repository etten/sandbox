<?php

namespace App\Front\Presenters;

use Project\Articles;

class ArticlePresenter extends RoutePresenter
{

	/**
	 * @var Articles\Articles
	 * @inject
	 */
	public $articles;

	public function renderDefault()
	{
		$this->template->article = $article = $this->articles->findOneByRoute($this->route);
	}

}
