<?php


namespace LaSalle\GroupSeven\User\Domain\Exception;


use LaSalle\GroupSeven\Core\Domain\DomainError;

class UserNotFoundException extends DomainError
{

    public function errorCode(): string
    {
        return 'Existing_User';
    }

    protected function errorMessage(): string
    {
        return sprintf('The user id provided not found or not exists. Try another');
    }
}