<?php

namespace LaSalle\GroupSeven\Core\Domain\Framework\Event;

use DateTimeImmutable;

abstract class DomainEvent
{
    private string $occurredOn;

    public function __construct(string $occurredOn = null)
    {
        $this->occurredOn =  $occurredOn ?: new DateTimeImmutable();
    }

    public function occurredOn(): string
    {
        return $this->occurredOn;
    }

}