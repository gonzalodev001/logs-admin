<?php

namespace LaSalle\GroupSeven\Core\Domain\ValueObject;

class LogLevel
{
    public function __construct(private string $level)
    {
    }

    public function level(): string
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }
}