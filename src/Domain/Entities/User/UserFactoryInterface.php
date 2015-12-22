<?php

namespace Malendar\Domain\Entities\User;

interface UserFactoryInterface
{
	public static function create($uuid, $name, $email, $password, $hashCode);
}