<?php

namespace App\Admin\Presenters;

use App\Forms\BootstrapBasicRenderer;
use App\Forms\FormFactory;
use Nette\Application;

abstract class BasePresenter extends Application\UI\Presenter
{

	/**
	 * @var FormFactory
	 * @inject
	 */
	public $formFactory;

	protected function startup()
	{
		parent::startup();

		if ($this->getPresenter()->getName() !== 'Admin:Sign' && !$this->getUser()->isLoggedIn()) {
			$this->redirect('Sign:in');
		}

		$this->formFactory->onCreate[] = function (Application\UI\Form $form) {
			$form->setRenderer(new BootstrapBasicRenderer());
		};
	}

}
