<?php

namespace LaSalle\GroupSeven\LogSummary\Domain;

final class LogSummary
{
    public function __construct(private string $id, private string $environment, private string $level, private int $count)
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

    public function level(): string
    {
        return $this->level;
    }

    public function count(): int
    {
        return $this->count;
    }

    public function addCount(): void
    {
        $this->count = ++$this->count;
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
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

}