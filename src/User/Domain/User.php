<?php


namespace LaSalle\GroupSeven\User\Domain;


use LaSalle\GroupSeven\User\Domain\Exception\InvalidPassword;

class User
{
    const pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    private string $id;
    private string $mail;
    private string $password;
    private array $roles;

    public function __construct(string $id, string $mail, string $password)
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->password = $password;
        $this->roles[] = 'ROLE_USER';
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

    public function roles(): array
    {
        return $this->roles;
    }

    public static function userRegistration(string $id, string $mail, string $password): User
    {
        self::validatePassword($password);
        return new self($id, $mail, $password,);
    }

    public static function validatePassword(string $password): void
    {
        if (!preg_match(self::pattern, $password)) {
            throw new InvalidPassword($password);
        }
    }

    public function addRole(string $role): void
    {
        $this->roles[] = $role;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }


}