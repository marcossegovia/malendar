<?php

namespace Malendar\Application\Service\User;

use Symfony\Component\HttpFoundation\Session\Session;

class LogoutUserService
{
	private $session;

	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	public function __invoke()
	{
		$this->session->clear();
	}
}