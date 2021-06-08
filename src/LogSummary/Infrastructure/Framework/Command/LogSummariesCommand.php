<?php

namespace LaSalle\GroupSeven\LogSummary\Infrastructure\Framework\Command;

use LaSalle\GroupSeven\LogSummary\Application\GetLogSummariesByEnvironmentAndLevelsUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

final class LogSummariesCommand extends Command
{
    protected static $defaultName = 'app:log:summaries';

    public function __construct(private GetLogSummariesByEnvironmentAndLevelsUseCase $getLogSummariesByEnvironmentAndLevelsUseCase)
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
        $levels = $helper->ask($input, $output, $question);

        $arrayLogSummaries = $this->getLogSummariesByEnvironmentAndLevelsUseCase->__invoke($logEnv, $levels);

        $table = new Table($output);
        $table->setHeaders(['Id', 'environment', 'Level', 'Count']);
        foreach ($arrayLogSummaries as $logSummary) {
            $table->addRow([$logSummary->id(), $logSummary->environment(), $logSummary->level(), $logSummary->count()]);
        }
        $table->render();

        return 0;
    }
}