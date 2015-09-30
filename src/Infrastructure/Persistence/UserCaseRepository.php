<?php


namespace Malendar\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Malendar\Domain\Entities\Repository\UserRepositoryInterface;
use Malendar\Domain\Entities\ValueObject\UserId;
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
    }

    public function add()
    {
        // TODO: Implement add() method.
    }

    public function findByEmail()
    {
        // TODO: Implement findByEmail() method.
    }

    public function findByUsername()
    {
        // TODO: Implement findByUsername() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

}