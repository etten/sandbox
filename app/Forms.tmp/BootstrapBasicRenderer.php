<?php

namespace App\Forms;

use Nette\Forms;

class BootstrapBasicRenderer extends Forms\Rendering\DefaultFormRenderer
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
			'container' => NULL,
		],
		'control' => [
			'container' => NULL,
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
		// make form and controls compatible with Twitter Bootstrap
		$this->wrappers = $this->bootstrapWrappers + $this->wrappers;

		foreach ($form->getControls() as $control) {
			if ($control instanceof Forms\Controls\Button) {
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
				$usedPrimary = TRUE;

			} elseif ($control instanceof Forms\Controls\TextBase ||
				$control instanceof Forms\Controls\SelectBox ||
				$control instanceof Forms\Controls\MultiSelectBox
			) {
				$control->getControlPrototype()->addClass('form-control');

			} elseif ($control instanceof Forms\Controls\Checkbox ||
				$control instanceof Forms\Controls\CheckboxList ||
				$control instanceof Forms\Controls\RadioList
			) {
				$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
			}
		}

		return parent::render($form);
	}

}
