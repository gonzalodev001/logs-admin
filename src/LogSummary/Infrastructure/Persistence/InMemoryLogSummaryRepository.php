<?php

namespace LaSalle\GroupSeven\LogSummary\Infrastructure\Persistence;

use LaSalle\GroupSeven\Log\Application\GetLogEntriesByEnvironmentUseCase;
use LaSalle\GroupSeven\LogSummary\Domain\LogSummary;
use LaSalle\GroupSeven\LogSummary\Domain\LogSummaryRepository;
use Symfony\Component\Uid\Uuid;

final class InMemoryLogSummaryRepository implements LogSummaryRepository
{
    private array $logSummaries;

    public function __construct(private GetLogEntriesByEnvironmentUseCase $getLogEntriesByEnvironmentUseCase)
    {
    }

    public function all(string $environment, array $levels): array
    {
        $this->logSummaries = [];
        $filteredArrayLogEntries = $this->getLogEntriesByEnvironmentUseCase->__invoke($environment, $levels);
        foreach ($filteredArrayLogEntries as $logEntry) {
            $newLevel = true;
            foreach ($this->logSummaries as $key => $logSummary) {
                if ($logSummary->level() == $logEntry->level()) {
                    $newLevel = false;
                    $this->logSummaries[$key]->addCount();
                }
            }
            if ($newLevel) {
                $uuid = Uuid::v4();
                $id = $uuid->toRfc4122();
                $this->logSummaries[] = new LogSummary($id, $logEntry->environment(), $logEntry->level(), 1);
            }
        }
        return $this->logSummaries;
    }
}