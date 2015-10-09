<?php

use Malendar\Application\Service\User\LoginUserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

ini_set('display_errors', 1);

require_once __DIR__ . '/../../vendor/autoload.php';

$app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();

// Register routes
$app->get('/', function () use ($app) {
    if (null === $app['session']->get('user')) {
        return $app->redirect($app["url_generator"]->generate("login"));
    }
    return $app->redirect($app["url_generator"]->generate("calendar"));
});

$app->get('/login', function () use ($app) {
    return new Response($app['twig']->render('login.html', ['formError' => false]), 200);
})->bind('login');

$app->post('/login', function (Request $request) use ($app) {

    $userRepository = $app['user_repository'];
    $session = $app['session'];

    $loginService = new \Malendar\Application\Service\User\LoginUserService($userRepository, $session);

    $success = $loginService->execute($request);

    if ($success) {
        return $app->redirect($app["url_generator"]->generate("calendar"));
    } else {
        return new Response($app['twig']->render('login.html', ['formError' => true]), 400);
    }
});

$app->get('/logout', function (Request $request) use ($app){

    $session = $app['session'];
    $logoutService = new \Malendar\Application\Service\User\LogoutUserService($session);

    $logoutService->execute($request);

    return $app->redirect($app["url_generator"]->generate("login"));

})->bind('logout');

$app->get('/calendar', function () use ($app) {
    return new Response($app['twig']->render('calendar.html'), 200);
})->bind('calendar');


$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    if ($code == 404) {
        return new Response($app['twig']->render('errors/404_e.html'), $code);
    }
    if ($code == 500) {
        return new Response($app['twig']->render('errors/500.html'), $code);
    }
    if (substr($code, 0, 1) == 4) {
        return new Response($app['twig']->render('errors/4xx.html'), $code);
    }
    if (substr($code, 0, 1) == 5) {
        return new Response($app['twig']->render('errors/5xx.html'), $code);
    }

    return new Response($app['twig']->render('errors/default.html'), $code);
});

$app->run();
