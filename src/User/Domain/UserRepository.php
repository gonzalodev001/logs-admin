<?php


namespace LaSalle\GroupSeven\User\Domain;


interface UserRepository
{
    public function save(User $user): void;

}