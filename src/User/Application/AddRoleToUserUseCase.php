<?php


namespace LaSalle\GroupSeven\User\Application;


use LaSalle\GroupSeven\User\Domain\UserRepository;

class AddRoleToUserUseCase
{

    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(string $id, string $role): void
    {
        $this->repository->addRoleToUser($id, $role);
    }
}