<?php

namespace LaSalle\GroupSeven\LogSummary\Infrastructure\Persistence;

use LaSalle\GroupSeven\LogSummary\Domain\LogSummary;
use LaSalle\GroupSeven\LogSummary\Domain\Repository\LogSummaryRepository;
use Psr\Cache\CacheItemPoolInterface;

final class CachePoolLogSummaryRepository implements LogSummaryRepository
{
    public function __construct(private CacheItemPoolInterface $cacheItemPoolInterface)
    {
    }

    public function findByEnvironmentAndLevels(string $environment, array $levels): array
    {
        $foundSummaries = [];
        foreach ($levels as $level) {
            $item = $this->cacheItemPoolInterface->getItem($environment.$level);
            if ($item->isHit()) {
                $foundSummaries[] = $item->get();
            }
        }
        return $foundSummaries;
    }

    public function save(LogSummary $logSummary): void
    {
        $item = $this->cacheItemPoolInterface->getItem($logSummary->environment().strtolower($logSummary->level()->level()));
        $item->set($logSummary);
        $this->cacheItemPoolInterface->save($item);
    }
}