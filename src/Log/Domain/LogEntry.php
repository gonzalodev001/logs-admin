<?php

namespace LaSalle\GroupSeven\Log\Domain;

use LaSalle\GroupSeven\Core\Domain\ValueObject\LogLevel;

final class LogEntry
{
    public function __construct(private string $id, private string $environment, private LogLevel $level, private string $message, private string $occurredOn)
    {
    }

    public function environment(): string
    {
        return $this->environment;
    }

    public function level(): LogLevel
    {
        return $this->level;
    }
}