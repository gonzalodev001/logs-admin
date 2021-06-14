<?php

namespace LaSalle\GroupSeven\LogSummary\Application;

use LaSalle\GroupSeven\LogSummary\Domain\Repository\LogSummaryRepository;

class GetLogSummariesByEnvironmentAndLevelsUseCase
{
    public function __construct(private LogSummaryRepository $repository)
    {
    }

    public function __invoke(string $environment = null, array $levelArray = null): array
    {
        if (is_null($environment)) {
            $environment = 'dev';
        }
        if (is_null($levelArray)) {
            $levelArray = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];
        }
        return $this->repository->findByEnvironmentAndLevels($environment, $levelArray);
    }
}