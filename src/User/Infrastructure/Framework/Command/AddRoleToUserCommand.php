<?php


namespace LaSalle\GroupSeven\User\Infrastructure\Framework\Command;


use LaSalle\GroupSeven\User\Application\AddRoleToUserUseCase;
use LaSalle\GroupSeven\User\Domain\Exception\UserNotFoundException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class AddRoleToUserCommand extends Command
{
    protected static $defaultName = 'app:user:add-role';

    public function __construct(private AddRoleToUserUseCase $addRoleToUserUseCase)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question(PHP_EOL.'<info>Please, input the user identifier:</info>'. PHP_EOL.'> ');
        $id = $helper->ask($input, $output, $question);

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            '<info>Please, select the user role(s) you want to add to this user:</info>',
            ['', 'developer'],
            '1'
        );
        $roles = $helper->ask($input, $output, $question);
        try {
            $this->addRoleToUserUseCase->__invoke($id, $roles);
        } catch (UserNotFoundException $exception) {
            $output->writeln('<error>Error: $exception->getMessage()</error>');
        }
        $question->setMaxAttempts(2);
    }
}