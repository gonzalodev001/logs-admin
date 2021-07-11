<?php


namespace LaSalle\GroupSeven\User\Domain;


interface UserRepository
{
    public function save(User $user): void;
    public function findByEmail(string $mail): bool;
    public function addRoleToUser(string $id, string $role): void;

}