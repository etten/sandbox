<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Object;

class FormFactory extends Object
{

	/**
	 * @var callable[]
	 */
	public $onCreate = [];

	/**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form;
		$this->onCreate($form);

		return $form;
	}

}
