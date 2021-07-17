<?php

namespace LaSalle\GroupSeven\Core\Domain\Framework\Event;

interface DomainEventBus
{
    public function publish(DomainEvent ...$event): void;
}