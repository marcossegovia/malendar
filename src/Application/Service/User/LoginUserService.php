<?php

namespace Malendar\Application\Service\User;

use Malendar\Application\Service\ApplicationServiceInterface;
use Malendar\Application\User\LoginUserCommand;
use Silex\Application;
use SimpleBus\Message\Bus\MessageBus;

class LoginUserService implements ApplicationServiceInterface
{
	private $commandBus;

	public function __construct(MessageBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function execute($request = NULL)
	{
		$command = new LoginUserCommand( $request->get( 'user' ), $request->get( 'password' ) );
		$this->commandBus->handle( $command );
	}
}