<?php

namespace LaSalle\GroupSeven\Core\Infrastructure\Framework\Event;

use LaSalle\GroupSeven\Core\Domain\Framework\Event\DomainEvent;
use LaSalle\GroupSeven\Core\Domain\Framework\Event\DomainEventBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class SymfonyMessengerDomainEventBus implements DomainEventBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function publish(DomainEvent $event): void
    {
        $this->messageBus->dispatch($event);
    }
}