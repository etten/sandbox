<?php

namespace App\Admin\Presenters;

use App\Forms\SignInFormFactory;

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

	protected function createComponentSignInForm()
	{
		$form = $this->signInFormFactory->create();

		$form->onSuccess[] = function () {
			$this->redirect(':Admin:Dashboard:');
		};

		return $form;
	}

}
