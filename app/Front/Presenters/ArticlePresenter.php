<?php

namespace App\Front\Presenters;

use App\Models\Articles\Articles;

class ArticlePresenter extends RoutePresenter
{

	/**
	 * @var Articles
	 * @inject
	 */
	public $articles;

	public function renderDefault()
	{
		$this->template->article = $article = $this->articles->findOneByRoute($this->route);
	}

}
