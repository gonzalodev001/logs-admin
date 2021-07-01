<?php

namespace LaSalle\GroupSeven\Log\Infrastructure\Framework\Command;

use LaSalle\GroupSeven\Log\Application\GetLogEntriesByEnvironmentUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class LogEntriesCommand extends Command
{
    protected static $defaultName = 'app:log-entries';

    public function __construct(private GetLogEntriesByEnvironmentUseCase $getLogEntriesByEnvironmentUseCase)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('environment', InputArgument::OPTIONAL, 'Only show the logs in the given environment <comment>[default: ""]</comment>');
        $this->addOption('level','l', InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, 'Filter the levels to show');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $logLevelArray = $input->getOption('level');
        if (empty($logLevelArray)) {
            $logLevelArray = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];
        }
        $logEnv = $input->getArgument('environment');
        if (is_null($logEnv)) {
            $logEnv = $_ENV['APP_ENV'];
        }
        dump($this->getLogEntriesByEnvironmentUseCase->__invoke($logEnv, $logLevelArray));
        return 0;
    }
}