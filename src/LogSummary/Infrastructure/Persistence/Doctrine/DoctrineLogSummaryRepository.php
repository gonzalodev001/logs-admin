<?php

namespace LaSalle\GroupSeven\LogSummary\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use LaSalle\GroupSeven\LogSummary\Domain\LogSummary;
use LaSalle\GroupSeven\LogSummary\Domain\Repository\LogSummaryRepository;

class DoctrineLogSummaryRepository implements LogSummaryRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findByEnvironmentAndLevels(string $environment, array $levels): array
    {
        $repository = $this->entityManager->getRepository(LogSummary::class);
        return $repository->findBy(['environment' => $environment, 'level.level' => $levels]);
    }

    public function save(LogSummary $logSummary): void
    {
        $this->entityManager->persist($logSummary);
        $this->entityManager->flush();
    }
}