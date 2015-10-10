<?php


namespace Malendar\Infrastructure\Factory;


use Malendar\Domain\Entities\ValueObject\UserId;
use Malendar\Domain\Entities\ValueObject\UserIdFactoryInterface;

class UserIdFactory implements UserIdFactoryInterface
{

    public static function create()
    {
        // TODO: Implement create() method.
        return new UserId();
    }
}