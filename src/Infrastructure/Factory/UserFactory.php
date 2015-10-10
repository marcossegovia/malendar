<?php


namespace Malendar\Infrastructure\Factory;


use Malendar\Domain\Entities\User\User;
use Malendar\Domain\Entities\User\UserFactoryInterface;

class UserFactory implements UserFactoryInterface
{

    public static function create($uuid, $name, $email, $password = null, $hashCode = null)
    {
        // TODO: Implement create() method.
        return new User($uuid, $name, $email, $password, $hashCode);
    }
}