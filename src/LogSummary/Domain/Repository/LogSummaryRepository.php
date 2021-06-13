<?php

namespace LaSalle\GroupSeven\LogSummary\Domain\Repository;

use LaSalle\GroupSeven\LogSummary\Domain\LogSummary;

interface LogSummaryRepository
{
    public function findByEnvironmentAndLevels(string $environment, array $levels): array;
    public function save(LogSummary $logSummary): void;
}