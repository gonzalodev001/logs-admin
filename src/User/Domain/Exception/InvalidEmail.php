<?php


namespace LaSalle\GroupSeven\User\Domain\Exception;


use LaSalle\GroupSeven\Core\Domain\DomainError;

class InvalidEmail extends DomainError
{

    public function __construct(private string $email)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_email';
    }

    protected function errorMessage(): string
    {
        return sprintf('The email provided is invalid. ', $this->email);
    }
}