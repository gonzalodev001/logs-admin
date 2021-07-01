<?php


namespace LaSalle\GroupSeven\User\Domain\Exception;


use LaSalle\GroupSeven\Core\Domain\DomainError;

class InvalidConfirmPassword extends DomainError
{

    public function errorCode(): string
    {
        return 'Invalid_confirm_password';
    }

    protected function errorMessage(): string
    {
        return sprintf('The passwords provided do not match, they are different. ');
    }
}