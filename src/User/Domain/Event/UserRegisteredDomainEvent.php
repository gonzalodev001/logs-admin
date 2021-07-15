<?php


namespace LaSalle\GroupSeven\User\Domain\Event;


use LaSalle\GroupSeven\Core\Domain\Framework\Event\DomainEvent;
use LaSalle\GroupSeven\User\Domain\User;

class UserRegisteredDomainEvent extends DomainEvent
{

    public function __construct(private User $user, string $occurredOn = null)
    {
        parent::__construct($occurredOn);
    }

    public function user(): User
    {
        return $this->user;
    }

}