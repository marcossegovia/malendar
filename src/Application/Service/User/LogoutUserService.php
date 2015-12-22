<?php

namespace Malendar\Application\Service\User;

use Malendar\Application\Service\ApplicationServiceInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class LogoutUserService implements ApplicationServiceInterface
{
	private $session;

	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	public function execute($request = NULL)
	{
		$this->session->clear();
	}
}