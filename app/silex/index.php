<?php

use Malendar\Application\Controller\CalendarController;
use Malendar\Application\Controller\LogInController;
use Symfony\Component\HttpFoundation\Response;

ini_set('display_errors', 0);

require_once __DIR__ . '/../../vendor/autoload.php';

$app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
$app['twig.path'] = array(__DIR__.'/../../src/Application/Resources/Templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

// Routing Added
//------------------------------------
$app['login.controller'] = $app->share(function () use ($app) {
    return new LogInController($app);
});
$app['calendar.controller'] = $app->share(function () use ($app) {
    return new CalendarController($app);
});

// Register routes
$app->get('/', 'login.controller:helloAction')->bind('homepage');
$app->get('/login', 'login.controller:helloAction');
$app->get('/calendar', 'calendar.controller:indexAction')->bind('calendar');
$app->post('/', 'login.controller:processLoginAction');
$app->post('/login', 'login.controller:processLoginAction');

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
//------------------------------------
// Services Added

$app->run();
