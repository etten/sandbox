<?php

namespace App\Admin\Presenters;

use App\Forms\SignInFormFactory;
use Nette\Application\UI\Form;

class SignPresenter extends BasePresenter
{

	/**
	 * @var SignInFormFactory
	 * @inject
	 */
	public $signInFormFactory;

	public function actionOut()
	{
		$this->getUser()->logout();
	}

	protected function createComponentSignInForm(): Form
	{
		$form = $this->signInFormFactory->create();

		$form->onSuccess[] = function () {
			$this->redirect(':Admin:Dashboard:');
		};

		return $form;
	}

}
