<?php

namespace App\Front\Presenters;

use App\Facade\ArticleFacade;

class ArticlePresenter extends RoutePresenter
{

	/**
	 * @var ArticleFacade
	 * @inject
	 */
	public $articleFacade;

	public function renderDefault()
	{
		$this->template->article = $article = $this->articleFacade->findOneByRoute($this->route);
	}

}
