<?php

namespace LaSalle\GroupSeven\Log\Application;

use LaSalle\GroupSeven\Log\Domain\LogEntry;
use LaSalle\GroupSeven\Log\Domain\LogRepository;

final class GetLogEntriesByEnvironmentUseCase
{
    public function __construct(private LogRepository $repository)
    {
    }

    /**
     * @param string $environment
     * @param array $levelArray
     * @return LogEntry[]
     */
    public function __invoke(string $environment, array $levelArray): array
    {
        $arrayLogEntries = $this->repository->findLogEntriesByEnvironment($environment);
        $filteredArrayLogEntries = [];
        foreach ($arrayLogEntries as $logEntry)
        {
            if (in_array(strtolower($logEntry->level()), $levelArray)) {
                $filteredArrayLogEntries[] = $logEntry;
            }
        }
        return $filteredArrayLogEntries;
    }
}

