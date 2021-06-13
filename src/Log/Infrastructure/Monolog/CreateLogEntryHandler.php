<?php

namespace LaSalle\GroupSeven\Log\Infrastructure\Monolog;

use LaSalle\GroupSeven\Log\Application\CreateLogEntryUseCase;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class CreateLogEntryHandler extends AbstractProcessingHandler
{
    public function __construct(private CreateLogEntryUseCase $createLogEntryUseCase, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        $this->createLogEntryUseCase->__invoke($record['extra']['uuid'], $record['extra']['env'], $record['level_name'], $record['message'], $record['datetime']);
    }
}