<?php


namespace LaSalle\GroupSeven\User\Domain;


use LaSalle\GroupSeven\User\Domain\Exception\InvalidPassword;

class User
{
    const pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    private string $id;
    private string $mail;
    private string $password;

    public function __construct(string $id, string $mail, string $password)
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->password = $password;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function mail(): string
    {
        return $this->mail;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function userRegistration(string $id, string $mail, string $password): User
    {

        return new self($id, $mail, $password);
    }

    public static function validatePassword(string $password): void
    {
        if (!preg_match(self::pattern, $password)) {
            throw new InvalidPassword($password);
        }
    }
}