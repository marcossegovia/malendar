<?php

namespace Malendar\Infrastructure\Factory;

use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Domain\Entities\ValueObject\EmailFactoryInterface;

class EmailFactory implements EmailFactoryInterface
{

	public static function create($email)
	{
		return new Email( $email );
	}
}