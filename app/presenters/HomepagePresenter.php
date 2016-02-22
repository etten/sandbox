<?php

namespace App\Presenters;

use Nette;

class HomepagePresenter extends BasePresenter
{

	public function handleDelete($id = 0)
	{
		throw new \Exception(sprintf('Cannot delete %d.', $id));
	}

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

}
