<?php

namespace LaSalle\GroupSeven\Log\Domain;

interface LogRepository
{
    /**
     * @param string $environment
     * @return LogEntry[]
     */
    public function findLogEntriesByEnvironment(string $environment): array;
}