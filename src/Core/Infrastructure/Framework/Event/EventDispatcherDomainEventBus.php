<?php

namespace LaSalle\GroupSeven\Core\Infrastructure\Framework\Event;

use LaSalle\GroupSeven\Core\Domain\Framework\Event\DomainEvent;
use LaSalle\GroupSeven\Core\Domain\Framework\Event\DomainEventBus;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class EventDispatcherDomainEventBus implements DomainEventBus
{
    public function __construct(private EventDispatcherInterface $eventDispatcher)
    {
    }

    public function publish(DomainEvent $event): void
    {
        $this->eventDispatcher->dispatch($event);
    }
}