<?php

namespace Malendar\Application\Service\User;

use Malendar\Domain\Entities\User\Exception\UserNotFoundException;
use Malendar\Domain\Entities\User\UserRepositoryInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Session\Session;

final class LoginUserService
{
	/** @var  UserRepositoryInterface */
	private $user_repository;

	/** @var Session */
	private $session_client;

	public function __construct(UserRepositoryInterface $my_user_repository, Session $my_session)
	{
		$this->user_repository = $my_user_repository;
		$this->session_client  = $my_session;
	}

	public function __invoke(LoginUserRequest $a_login_request)
	{
		$user = $this->user_repository->findByUsername( $a_login_request->username() );

		if (empty( $user ) || !isset( $user ))
		{
			throw new UserNotFoundException();
		}

		$user->validate( $a_login_request->password() );

		$this->session_client->start();
		$this->session_client->set( 'user', array(
											  'id'       => $user->getUserId(),
											  'username' => $user->getName(),
											  'email'    => $user->getEmail()
										  )
		);
	}
}