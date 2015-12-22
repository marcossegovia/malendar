<?php

use Malendar\Application\Service\User\LoginUserRequest;
use Malendar\Application\Service\User\LoginUserService;
use Malendar\Application\Service\User\LogoutUserService;
use Malendar\Domain\Entities\User\Exception\UnauthorizedUserException;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->get( '/', function () use ($app)
{
	if (NULL === $app['session']->get( 'user' ))
	{
		return $app->redirect( $app["url_generator"]->generate( "login" ) );
	}

	return $app->redirect( $app["url_generator"]->generate( "dashboard" ) );
}
);

$app->get( '/login', function () use ($app)
{
	return new Response( $app['twig']->render( 'login.twig', ['formError' => FALSE] ), 200 );
}
)->bind( 'login' );

$app->post( '/login', function (Request $request) use ($app)
{

	try
	{
		$login_user_request = new LoginUserRequest( $request->get( 'user' ), $request->get( 'password' ) );
		$loginService       = new LoginUserService( $app['user_repository'], $app['session'] );
		$loginService->__invoke( $login_user_request );
	}
	catch ( UnauthorizedUserException $e )
	{
		return new Response( $app['twig']->render( 'login.twig', ['formError' => TRUE] ), $e->getCode() );
	}

	return $app->redirect( $app["url_generator"]->generate( "dashboard" ) );
}
);

$app->get( '/logout', function (Request $request) use ($app)
{
	$session       = $app['session'];
	$logoutService = new LogoutUserService( $session );

	$logoutService->__invoke();

	return $app->redirect( $app["url_generator"]->generate( "login" ) );

}
)->bind( 'logout' );

$app->get( '/dashboard', function (Request $request) use ($app)
{
	if (NULL === $app['session']->get( 'user' ))
	{
		return $app->redirect( $app["url_generator"]->generate( "login" ) );
	}

	return new Response( $app['twig']->render( 'dashboard.twig', ['user' => $app['session']->get( 'user' )] ), 200 );
}
)->bind( 'dashboard' );

$app->get( '/calendar', function () use ($app)
{
	if (NULL === $app['session']->get( 'user' ))
	{
		return $app->redirect( $app["url_generator"]->generate( "login" ) );
	}

	return new Response( $app['twig']->render( 'calendar.twig' ), 200 );
}
)->bind( 'calendar' );

$app->error( function (\Exception $e, $code) use ($app)
{

	echo $e->getMessage();
	if ($app['debug'])
	{
		return;
	}
	if ($code == 404)
	{
		return new Response( $app['twig']->render( 'errors/404_e.twig' ), $code );
	}
	if ($code == 500)
	{

		return new Response( $app['twig']->render( 'errors/500.twig' ), $code );
	}
	if (substr( $code, 0, 1 ) == 4)
	{
		return new Response( $app['twig']->render( 'errors/4xx.twig' ), $code );
	}
	if (substr( $code, 0, 1 ) == 5)
	{
		return new Response( $app['twig']->render( 'errors/5xx.twig' ), $code );
	}

	return new Response( $app['twig']->render( 'errors/default.twig' ), $code );
}
);