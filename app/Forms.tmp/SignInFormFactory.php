<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Security;

class SignInFormFactory
{

	/** @var FormFactory */
	private $factory;

	/** @var Security\User */
	private $user;

	public function __construct(FormFactory $factory, Security\User $user)
	{
		$this->factory = $factory;
		$this->user = $user;
	}

	/**
	 * @return Form
	 */
	public function create()
	{
		$form = $this->factory->create();

		$form->addText('username', 'Username')
			->setRequired();

		$form->addPassword('password', 'Password')
			->setRequired();

		$form->addCheckbox('remember', 'Keep me signed in');

		$form->addSubmit('send', 'Sign in');

		$form->onSuccess[] = [$this, 'formSuccess'];

		return $form;
	}

	public function formSuccess(Form $form, $values)
	{
		if ($values['remember']) {
			$this->user->setExpiration('14 days', FALSE);
		} else {
			$this->user->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->user->login($values['username'], $values['password']);
		} catch (Security\AuthenticationException $e) {
			$form->addError('The username or password you entered is incorrect.');
		}
	}

}
