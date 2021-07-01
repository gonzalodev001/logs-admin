<?php


namespace LaSalle\GroupSeven\User\Application;


use LaSalle\GroupSeven\User\Domain\Exception\ExistingUser;
use LaSalle\GroupSeven\User\Domain\User;
use LaSalle\GroupSeven\User\Domain\UserRepository;

class RegisterUser
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(string $id, string $mail, string $password, string $confirmPassword)
    {
        $verify = $this->userRepository->findByEmail($mail);
        if ($verify) {
            throw new ExistingUser();
        }
        $user = User::userRegistration($id, $mail, $password, $confirmPassword);
        $this->userRepository->save($user);
    }
}