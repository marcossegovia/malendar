<?php

namespace Malendar\Domain\Model\User\Exception;

class UnauthorizedUserException extends \DomainException
{
	protected $code = '403';
}