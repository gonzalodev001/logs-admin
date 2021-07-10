<?php


namespace LaSalle\GroupSeven\Log\Application;


use LaSalle\GroupSeven\Log\Domain\Repository\LogRepository;

class AllLogEntriesByEnvironmentUseCase
{

    public function __construct(private LogRepository $repository)
    {
    }

    public function __invoke(string $environment, int $currentPage, int $limit): array
    {
        return $this->repository->findLogEntriesByEnvironment($environment, $currentPage, $limit);
    }
}