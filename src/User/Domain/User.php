<?php


namespace LaSalle\GroupSeven\User\Domain;


use LaSalle\GroupSeven\User\Domain\Exception\InvalidConfirmPassword;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidEmail;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidPassword;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    const pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    /**
     * @ORM\Column(type="string")
     */
    private string $id;
    /**
     * @ORM\Column(type="string")
     */
    private string $mail;
    /**
     * @ORM\Column(type="string")
     */
    private string $password;
    /**
     * @ORM\Column(type="json")
     */
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

    public static function userRegistration(string $id, string $mail, string $password, string $confirmPassword): User
    {
        self::validateEmail($mail);
        self::validatePassword($password);
        self::validateConfirmPassword($password, $confirmPassword);
        return new self($id, $mail, $password,);
    }

    public static function validatePassword(string $password): void
    {
        if (!preg_match(self::pattern, $password)) {
            throw new InvalidPassword($password);
        }
    }

    public static function validateEmail(string $email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmail($email);
        }
    }

    public static function validateConfirmPassword(string $password, string $confirmPassword): void
    {
        if($password !== $confirmPassword) {
            throw new InvalidConfirmPassword();
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


    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}