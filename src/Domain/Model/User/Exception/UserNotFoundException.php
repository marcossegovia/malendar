<?php

namespace Malendar\Domain\Model\User\Exception;

final class UserNotFoundException extends UnauthorizedUserException
{
	protected $message = 'The user is not registered.';
}