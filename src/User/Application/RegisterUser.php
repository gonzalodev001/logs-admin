<?php


namespace LaSalle\GroupSeven\User\Application;


use LaSalle\GroupSeven\User\Domain\User;
use LaSalle\GroupSeven\User\Domain\UserRepository;
use Symfony\Component\Uid\Uuid;

class RegisterUser
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(string $id, string $mail, string $password)
    {
        $uuid = Uuid::v4();
        $id = $uuid->toRfc4122();
        $user = User::userRegistration($id, $mail, $password);
        $this->userRepository->save($user);
    }
}