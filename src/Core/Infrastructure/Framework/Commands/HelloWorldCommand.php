<?php

namespace LaSalle\GroupSeven\Core\Infrastructure\Framework\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class HelloWorldCommand extends Command
{
    protected static  $defaultName = 'app:hello-world';

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('hello world');
        return 0;
    }
}