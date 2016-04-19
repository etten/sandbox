<?php

namespace App\Models\Users\Console;

use App\Facade\UserFacade;
use App\Models\Users\User;
use Symfony\Component\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCommand extends Console\Command\Command
{

	/** @var UserFacade */
	private $userFacade;

	public function __construct(UserFacade $userFacade)
	{
		parent::__construct('user:create');
		$this->userFacade = $userFacade;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		/** @var Console\Helper\QuestionHelper $helper */
		$helper = $this->getHelper('question');

		$question = new Console\Question\Question('Enter the username: ');
		$username = $helper->ask($input, $output, $question);

		$question = new Console\Question\Question('Enter the password: ');
		$question->setHidden(TRUE);
		$question->setHiddenFallback(FALSE);
		$password = $helper->ask($input, $output, $question);

		$user = new User($username, $password);
		$this->userFacade->save($user);

		$output->writeln(sprintf('User %s was created.', $username));
	}

}
