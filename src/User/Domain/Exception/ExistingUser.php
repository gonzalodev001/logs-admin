<?php


namespace LaSalle\GroupSeven\User\Domain\Exception;


use LaSalle\GroupSeven\Core\Domain\DomainError;

class ExistingUser extends DomainError
{

    public function errorCode(): string
    {
        return 'Existing_User';
    }

    protected function errorMessage(): string
    {
        return sprintf('The email provided already exists. Try another');
    }
}