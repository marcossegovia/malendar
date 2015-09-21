<?php


namespace Malendar\Infrastructure\Persistence;

use Malendar\Domain\Entities\Repository\UserRepositoryInterface;
use Malendar\Domain\Entities\ValueObject\UserId;

class UserCaseRepository implements UserRepositoryInterface
{
    private $em;

    public function __construct()
    {
        //EntityManager (DOCTRINE)
        //$this->$em = $em;
    }

    public function nextIdentity()
    {
        // TODO: Implement nextIdentity() method.
        return new UserId();

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