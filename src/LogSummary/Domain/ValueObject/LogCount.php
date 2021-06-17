<?php


namespace LaSalle\GroupSeven\LogSummary\Domain\ValueObject;


class LogCount
{

    public function __construct(private int $count)
    {
    }

    public  function count(): int
    {
        return $this->count;
    }

    public function addCount(): void
    {
        $this->count = ++$this->count;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}