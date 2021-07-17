<?php


namespace LaSalle\GroupSeven\Core\Domain\Framework\Repository;


use LaSalle\GroupSeven\User\Domain\User;

interface MailRepository
{
    public function sendMail(User $user): void;
}