<?php


namespace LaSalle\GroupSeven\LogSummary\Application;


use LaSalle\GroupSeven\Core\Domain\Framework\Event\DomainEventBus;
use LaSalle\GroupSeven\Log\Domain\Event\LogEntryCreatedDomainEvent;
use LaSalle\GroupSeven\LogSummary\Domain\LogSummary;
use LaSalle\GroupSeven\LogSummary\Domain\Repository\LogSummaryRepository;
use Symfony\Component\Uid\Uuid;

class AddLogEntryToLogSummaryWhenLogEntryCreated
{
    public function __construct(private LogSummaryRepository $repository)
    {
    }

    public function __invoke(LogEntryCreatedDomainEvent $event): void
    {
        $levelArray[] = strtolower($event->logEntry()->level());
        $logSummaries = $this->repository->findByEnvironmentAndLevels($event->logEntry()->environment(), $levelArray);
        $level = $event->logEntry()->level();
        if (empty($logSummaries[0])) {
            $uuid = Uuid::v4();
            $id = $uuid->toRfc4122();
            $logSummaries[] = new LogSummary(
                $id,
                $event->logEntry()->environment(),
                $level,
                0
            );
        }
        $logSummaries[0]->addCount();
        $this->repository->save($logSummaries[0]);
    }
}