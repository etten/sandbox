<?php

namespace App\Front\Presenters;

use Nette;

class HomepagePresenter extends BasePresenter
{

	public function handleDelete($id = 0)
	{
		throw new Nette\Application\BadRequestException(sprintf('Cannot delete %d.', $id));
	}

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

}
