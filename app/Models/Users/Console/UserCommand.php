<?php

namespace App\Models\Users\Console;

use App\Models\Users;
use Symfony\Component\Console;

class UserCommand extends Console\Command\Command
{

	/** @var Users\Users */
	private $users;

	public function __construct(Users\Users $users)
	{
		parent::__construct('user:create');
		$this->users = $users;
	}

	protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
	{
		/** @var Console\Helper\QuestionHelper $helper */
		$helper = $this->getHelper('question');

		$question = new Console\Question\Question('Enter the username: ');
		$username = $helper->ask($input, $output, $question);

		$question = new Console\Question\Question('Enter the password: ');
		$question->setHidden(TRUE);
		$question->setHiddenFallback(FALSE);
		$password = $helper->ask($input, $output, $question);

		$user = new Users\User($username, $password);
		$this->users->save($user);

		$output->writeln(sprintf('User %s was created.', $username));
	}

}
