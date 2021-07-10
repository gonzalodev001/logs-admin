<?php

namespace LaSalle\GroupSeven\Log\Domain\Repository;

use LaSalle\GroupSeven\Log\Domain\LogEntry;

interface LogRepository
{
    /**
     * @param string $environment
     * @return LogEntry[]
     */
    public function findLogEntriesByEnvironment(string $environment, int $currentPage, int $limit): array;

    public function save(LogEntry $logEntry): void;
}