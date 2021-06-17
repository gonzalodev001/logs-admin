<?php

namespace LaSalle\GroupSeven\LogSummary\Domain;

use LaSalle\GroupSeven\Core\Domain\ValueObject\LogLevel;
use LaSalle\GroupSeven\LogSummary\Domain\ValueObject\LogCount;

final class LogSummary
{
    public function __construct(private string $id, private string $environment, private LogLevel $level, private LogCount $count)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function environment(): string
    {
        return $this->environment;
    }

    public function level(): LogLevel
    {
        return $this->level;
    }

    public function count(): LogCount
    {
        return $this->count;
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
     * @return LogCount
     */
    public function getCount(): LogCount
    {
        return $this->count;
    }

}