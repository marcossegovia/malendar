<?php


namespace Malendar\Domain\Entities\Master;


interface MasterFactoryInterface
{
    public static function create($uuid, $name, $acronym, $description, $created_at);
}