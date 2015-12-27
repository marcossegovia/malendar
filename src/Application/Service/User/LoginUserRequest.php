<?php

namespace Malendar\Application\Service\User;

final class LoginUserRequest
{
	private $raw_username;
	private $raw_password;

	public function __construct(
		$a_raw_username,
		$a_raw_password
	)
	{
		$this->raw_username = $a_raw_username;
		$this->raw_password = $a_raw_password;
	}

	public function username()
	{
		return $this->raw_username;
	}

	public function password()
	{
		return $this->raw_password;
	}
}