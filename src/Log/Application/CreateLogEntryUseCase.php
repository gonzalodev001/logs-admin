<?php

namespace LaSalle\GroupSeven\Log\Application;

use LaSalle\GroupSeven\Core\Domain\Framework\Event\DomainEventBus;
use LaSalle\GroupSeven\Log\Domain\Event\LogEntryCreatedDomainEvent;
use LaSalle\GroupSeven\Log\Domain\LogEntry;
use LaSalle\GroupSeven\Log\Domain\Repository\LogRepository;

final class CreateLogEntryUseCase
{
    public function __construct(private LogRepository $repository, private DomainEventBus $domainEventBus)
    {
    }

    public function __invoke(string $id, string $environment, string $level, string $message, string $occurredOn): void
    {
        $logEntry = new LogEntry($id, $environment, $level, $message, $occurredOn);
        $this->repository->save($logEntry);
        $event = new LogEntryCreatedDomainEvent($logEntry);
        $this->domainEventBus->publish($event);
    }
}