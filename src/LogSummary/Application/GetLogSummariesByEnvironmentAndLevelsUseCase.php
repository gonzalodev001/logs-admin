<?php

namespace LaSalle\GroupSeven\LogSummary\Application;

use LaSalle\GroupSeven\LogSummary\Domain\Repository\LogSummaryRepository;

class GetLogSummariesByEnvironmentAndLevelsUseCase
{
    public function __construct(private LogSummaryRepository $repository)
    {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(string $environment = null, array $levelArray = null): array
    {
        if (is_null($environment)) {
            $environment = 'dev';
        }

        if (is_null($levelArray)) {
            $levelArray = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];
        }
        self::validateEnvironment($environment);
        self::validateLevels($levelArray);
        return $this->repository->findByEnvironmentAndLevels($environment, $levelArray);
    }

    public static function validateEnvironment(string $environment): void
    {
        $envs = ['dev','prod'];
        if(!in_array($environment, $envs)) {
            throw new \Exception('Error: 404, Invalid environment', 404);
        }
    }

    public static function validateLevels(array $levels): void
    {
        $levelArray = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];
        foreach ($levels as $level) {
            if (!in_array($level,$levelArray)) {
                throw new \Exception('Error: 400, Invalid Level', 400);
            }
        }
    }
}