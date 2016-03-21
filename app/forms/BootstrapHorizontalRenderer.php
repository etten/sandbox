<?php

namespace App\Forms;

use Nette\Forms;

class BootstrapHorizontalRenderer extends BootstrapBasicRenderer
{

	public $bootstrapWrappers = [
		'controls' => [
			'container' => NULL,
		],
		'pair' => [
			'container' => 'div class=form-group',
			'.error' => 'has-error',
		],
		'label' => [
			'container' => 'div class="col-sm-3 control-label"',
		],
		'control' => [
			'container' => 'div class=col-sm-9',
			'description' => 'span class=help-block',
			'errorcontainer' => 'span class=help-block',
		],
	];

	/**
	 * Provides complete form rendering.
	 * @param Forms\Form $form
	 * @return string
	 */
	public function render(Forms\Form $form)
	{
		$form->getElementPrototype()->addClass('form-horizontal');
		return parent::render($form);
	}

}
