<?php

namespace LaSalle\GroupSeven\Log\Domain\Event;

use LaSalle\GroupSeven\Core\Domain\Framework\Event\DomainEvent;
use LaSalle\GroupSeven\Log\Domain\LogEntry;

final class LogEntryCreatedDomainEvent extends DomainEvent
{
    public function __construct(private LogEntry $logEntry)
    {
        parent::__construct();
    }

    public function logEntry(): LogEntry
    {
        return $this->logEntry;
    }
}