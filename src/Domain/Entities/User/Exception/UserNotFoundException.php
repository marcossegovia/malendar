<?php

namespace Malendar\Domain\Entities\User\Exception;

final class UserNotFoundException extends UnauthorizedUserException
{
	protected $message = 'The user is not registered.';
}