<?php

namespace LaSalle\GroupSeven\Log\Domain;

final class LogEntry
{
    public function __construct(private string $id, private string $environment, private string $level, private string $message, private string $occurredOn)
    {
    }

    public function level(): string
    {
        return $this->level;
    }
}