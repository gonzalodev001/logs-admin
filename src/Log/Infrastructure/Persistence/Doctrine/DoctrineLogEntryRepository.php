<?php


namespace LaSalle\GroupSeven\Log\Infrastructure\Persistence\Doctrine;


use Doctrine\ORM\EntityManagerInterface;
use LaSalle\GroupSeven\Log\Domain\LogEntry;
use LaSalle\GroupSeven\Log\Domain\Repository\LogRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class DoctrineLogEntryRepository implements LogRepository
{

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findLogEntriesByEnvironment(string $environment, int $currentPage, int $limit): array
    {
        //$repository = $this->entityManager->getRepository(LogEntry::class);
        //$e = $repository->findBy(['environment' => $environment])->
        //$dql = 'SELECT partial p.{id, message, occurredOn, level.level}
        //$dql = 'SELECT partial p.{id, message, occurredOn, level.level}
        $dql = 'SELECT p
                FROM LaSalle\GroupSeven\Log\Domain\LogEntry p';

        $query = $this->entityManager->createQuery($dql);
        $paginator = $this->paginate($query, $currentPage, $limit);
        $count = $paginator->count();

        return array('paginator' => $paginator, 'query' => $query, 'count' => $count, 'limit' => $limit);

    }

    public function save(LogEntry $logEntry): void
    {
        $this->entityManager->persist($logEntry);
        $this->entityManager->flush();
    }

    public function paginate($dql, $page, $limit): Paginator
    {
        $paginator = new Paginator($dql);
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit

        return $paginator;
    }
}