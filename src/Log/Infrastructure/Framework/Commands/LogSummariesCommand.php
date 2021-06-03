<?php

namespace LaSalle\GroupSeven\Log\Infrastructure\Framework\Commands;

use LaSalle\GroupSeven\Log\Application\GetLogEntriesByEnvironmentUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

final class LogSummariesCommand extends Command
{
    protected static $defaultName = 'app:log:summaries';

    public function __construct(private GetLogEntriesByEnvironmentUseCase $getLogEntriesByEnvironmentUseCase)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $question = new Question(PHP_EOL.'Which environment do you want to generate a summary? <comment>[dev]</comment>:'. PHP_EOL.'> ', 'dev');
        $logEnv = $helper->ask($input, $output, $question);

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Please, specify for which levels you want to generate summary:',
            ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'],
            '0,1,2,3,4,5,6,7'
        );
        $question->setMultiselect(true);
        $levelArray = $helper->ask($input, $output, $question);

        $logEntriesByEnvironment = $this->getLogEntriesByEnvironmentUseCase->__invoke($logEnv, $levelArray);

        $logSummaries = [];
        foreach ($logEntriesByEnvironment as $logEntry) {
            $logEntryLevel = strtolower($logEntry->level());
            if (!array_key_exists($logEntryLevel, $logSummaries)) {
                $logSummaries[$logEntryLevel] = 1;
            } else {
                $logSummaries[$logEntryLevel] = ++$logSummaries[$logEntryLevel];
            }
        }

        $table = new Table($output);
        $table->setHeaders(['Level', 'Count']);
        foreach ($logSummaries as $key => $value) {
            $table->addRows([[$key, $value]]);
        }
        $table->render();

        return 0;
    }
}