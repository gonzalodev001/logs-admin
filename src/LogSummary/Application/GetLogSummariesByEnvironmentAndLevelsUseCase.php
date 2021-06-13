<?php

namespace LaSalle\GroupSeven\LogSummary\Application;

use LaSalle\GroupSeven\LogSummary\Domain\Repository\LogSummaryRepository;

class GetLogSummariesByEnvironmentAndLevelsUseCase
{
    public function __construct(private LogSummaryRepository $repository)
    {
    }

    public function __invoke(string $environment, array $levelArray): array
    {
        return $this->repository->findByEnvironmentAndLevels($environment, $levelArray);
    }
}