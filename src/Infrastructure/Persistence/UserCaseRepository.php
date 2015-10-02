<?php


namespace Malendar\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Malendar\Domain\Entities\Repository\UserRepositoryInterface;
use Malendar\Domain\Entities\ValueObject\UserId;
use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Domain\Entities\User\User;
use Doctrine\ORM\EntityManager;

class UserCaseRepository implements UserRepositoryInterface
{
    private $em;
    private $users;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function nextIdentity()
    {
        // TODO: Implement nextIdentity() method.
        return new UserId();

    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $query = $this->em->createQuery('SELECT u FROM Malendar\Domain\Entities\User\User u');
            return $query->getResult();
    }

    public function add(User $user)
    {
        // TODO: Implement add() method.
        $this->em->persist($user);
        $this->em->persist($user->getUserId());
        $this->em->flush();
    }

    public function findByEmail(Email $email)
    {
        // TODO: Implement findByEmail() method.
        $query = $this->em->createQuery('SELECT u FROM Malendar\Domain\Entities\User\User u WHERE u.email = :email');
        $query->setParameter('email', $email->getEmail());
        $user = $query->getResult();
        return new User($user[0]->getUserId(), $user[0]->getName(), $user[0]->getEmail(), null);
    }

    public function findByUsername($username)
    {
        // TODO: Implement findByUsername() method.
        $query = $this->em->createQuery('SELECT u FROM Malendar\Domain\Entities\User\User u WHERE u.name = :name');
        $query->setParameter('name', $username);
        $user = $query->getResult();
        return new User($user[0]->getUserId(), $user[0]->getName(), $user[0]->getEmail(), null);
    }

    public function update(User $user)
    {
        // TODO: Implement update() method.
    }

    public function remove(User $user)
    {
        // TODO: Implement remove() method.
    }

}