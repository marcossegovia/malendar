<?php

namespace Malendar\Domain\Entities\User\Exception;

final class UserValidationException extends UnauthorizedUserException
{
	protected $message = 'The user and password provided do not match.';
}