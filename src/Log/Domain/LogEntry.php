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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @return LogLevel
     */
    public function getLevel(): LogLevel
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getOccurredOn(): string
    {
        return $this->occurredOn;
    }


}