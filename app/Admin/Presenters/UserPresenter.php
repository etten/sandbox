<?php

/**
 * This file is part of Artfocus EuroEkonom.
 * Copyright © 2016 Jaroslav Hranička <hranicka@outlook.com>
 */

namespace App\Admin\Presenters;

use App\Models\Users\User;
use App\Models\Users\Users;
use Nette\Application\UI\Form;

class UserPresenter extends BasePresenter
{

	/**
	 * @var Users
	 * @inject
	 */
	public $users;

	protected function createComponentEditForm()
	{
		$form = $this->formFactory->create();

		$form->addPassword('currentPass', 'Současné heslo')
			->setRequired();

		$form->addPassword('newPass', 'Nové heslo')
			->setRequired();

		$form->addPassword('confirmPass', 'Ještě jednou')
			->setRequired()
			->addRule($form::EQUAL, 'Hesla se neshodují.', $form['newPass']);

		$form->addSubmit('send', 'Uložit');

		$form->onValidate[] = [$this, 'editFormValidate'];
		$form->onSuccess[] = [$this, 'editFormSuccess'];

		return $form;
	}

	public function editFormValidate(Form $form, $values)
	{
		if (!$this->getLoggedUser()->verifyPassword($values['currentPass'])) {
			$form->addError('Současné heslo není správné.');
		}
	}

	public function editFormSuccess(Form $form, $values)
	{
		$user = $this->getLoggedUser();
		$user->setPassword($values['newPass']);
		$this->users->save($user);

		$this->flashMessage('Heslo jsme změnili. Nyní se znovu přihlaste.');
		$this->user->logout(TRUE);
		$this->redirect('Sign:in');
	}

	private function getLoggedUser():User
	{
		$id = $this->getUser()->getIdentity()->getId();
		return $this->users->find($id);
	}

}
