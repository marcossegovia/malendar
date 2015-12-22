<?php

namespace Malendar\Domain\Entities\User\Exception;

class UnauthorizedUserException extends \DomainException
{
	protected $code = '403';
}