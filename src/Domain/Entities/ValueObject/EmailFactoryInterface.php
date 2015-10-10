<?php


namespace Malendar\Domain\Entities\ValueObject;


interface EmailFactoryInterface
{
    public static function create($email);
}