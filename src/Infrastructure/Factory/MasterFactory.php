<?php

namespace Malendar\Infrastructure\Factory;

use Malendar\Domain\Entities\Master\Master;
use Malendar\Domain\Entities\Master\MasterFactoryInterface;

class MasterFactory implements MasterFactoryInterface
{
	public static function create($uuid, $name, $acronym, $description, $created_at)
	{
		return new Master( $uuid, $name, $acronym, $description, $created_at );
	}
}