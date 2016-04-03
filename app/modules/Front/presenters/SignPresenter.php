<?php

namespace App\Front\Presenters;

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
			$this->redirect('Homepage:');
		};

		return $form;
	}

}
