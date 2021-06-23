<?php


namespace LaSalle\GroupSeven\User\Domain\Exception;


use LaSalle\GroupSeven\Core\Domain\DomainError;

class InvalidPassword extends DomainError
{
    public function __construct(private string $password)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_password';
    }

    protected function errorMessage(): string
    {
        return sprintf('The password provided is invalid. It should contain one capital letter, one number and least 8 characters ', $this->password);
    }
}