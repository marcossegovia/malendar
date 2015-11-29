<?php


namespace Malendar\Infrastructure\Factory;

use Malendar\Domain\Entities\ValueObject\UserIdFactoryInterface;
use Malendar\Domain\Entities\ValueObject\UuId;

class UuIdFactory implements UserIdFactoryInterface
{

    public static function create()
    {
        return new UuId();
    }
}