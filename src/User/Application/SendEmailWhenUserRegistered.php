<?php


namespace LaSalle\GroupSeven\User\Application;


use LaSalle\GroupSeven\Core\Domain\Framework\Repository\MailRepository;
use LaSalle\GroupSeven\User\Domain\Event\UserRegisteredDomainEvent;
use LaSalle\GroupSeven\User\Domain\UserRepository;

class SendEmailWhenUserRegistered
{

    public function __construct(private MailRepository $mailRepository)
    {
    }

    public function __invoke(UserRegisteredDomainEvent $event): void
    {
        $user = $event->user();
        $this->mailRepository->sendMail($user);
    }
}