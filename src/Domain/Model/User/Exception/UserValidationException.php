<?php

namespace Malendar\Domain\Model\User\Exception;

final class UserValidationException extends UnauthorizedUserException
{
	protected $message = 'The user and password provided do not match.';
}