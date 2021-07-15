<?php


namespace LaSalle\GroupSeven\User\Infrastructure\Persistence\Doctrine;


use Doctrine\ORM\EntityManagerInterface;
use LaSalle\GroupSeven\User\Domain\Exception\UserNotFoundException;
use LaSalle\GroupSeven\User\Domain\User;
use LaSalle\GroupSeven\User\Domain\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DoctrineUserRepository implements UserRepository
{
    public function __construct(private EntityManagerInterface $entityManager, private UserPasswordEncoderInterface $passwordEncoder)
    {
    }

    public function save(User $user): void
    {
        $user->setPassword($this->passwordEncoder->encodePassword($user, $user->password()));
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findByEmail(string $mail): bool
    {
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->findOneBy(['mail' => $mail]);
        if ($user) {
           return true;
        }
        return false;
    }

    public function addRoleToUser(string $id, string $role): void
    {
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->find($id);

        if(!$user) {
            throw  new UserNotFoundException();
        }
        $roles = $user->addRole(strtoupper($role));
        $user->setRoles($roles);
        $this->entityManager->flush();
    }

    public function sendMail(): void
    {
        // TODO: Implement sendMail() method.
    }
}