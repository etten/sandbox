<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Object;

class FormFactory extends Object
{

	/** @var callable[] */
	public $onCreate = [];

	public function create(): Form
	{
		$form = new Form;
		$this->onCreate($form);

		return $form;
	}

}
