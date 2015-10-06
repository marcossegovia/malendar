<?php

use Symfony\Component\HttpFoundation\Response;

ini_set('display_errors', 0);

require_once __DIR__ . '/../../vendor/autoload.php';

$app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
$app['twig.path'] = array(__DIR__ . '/../../src/Application/Resources/Templates');
$app['twig.options'] = array('cache' => __DIR__ . '/../var/cache/twig');

// Register routes
$app->get('/', function () use ($app) {
    return new Response($app['twig']->render('login.html', ['formError' => false]), 200);
})->bind('homepage');

$app->get('/login', function () use ($app) {
    return new Response($app['twig']->render('login.html', ['formError' => false]), 200);
});

$app->get('/calendar', function () use ($app) {
    return new Response($app['twig']->render('calendar.html'), 200);
})->bind('calendar');

$app->post('/', function () use ($app) {
    //missing loginService
    $userName = $app['request']->get('user');
    $password = $app['request']->get('password');
    $userRepository = $app['user_repository'];
    $user = $userRepository->findByUsername($userName);
    if (!empty($user) && $user->validate($password)) {
        return $app->redirect($app["url_generator"]->generate("calendar"));
    } else {
        return new Response($app['twig']->render('login.html', ['formError' => true]), 400);
    }
});

$app->post('/login', function () use ($app) {
    //missing loginService
    $userName = $app['request']->get('user');
    $password = $app['request']->get('password');
    $userRepository = $app['user_repository'];
    $user = $userRepository->findByUsername($userName);
    if (!empty($user) && $user->validate($password)) {
        return $app->redirect($app["url_generator"]->generate("calendar"));
    } else {
        return new Response($app['twig']->render('login.html', ['formError' => true]), 400);
    }
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    if ($code == 404) {
        return new Response($app['twig']->render('errors/404_e.html'), $code);
    }
    if ($code == 500) {
        return new Response($app['twig']->render('errors/505.html'), $code);
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
