<?php

use Malendar\Application\Controller\LogInController;
use Malendar\Application\Controller\CalendarController;
use Symfony\Component\HttpFoundation\Response;

// Register Controllers and their dependencies
$app['welcome.controller'] = $app->share(function () use ($app) {
    return new LogInController($app);
});
$app['calendar.controller'] = $app->share(function () use ($app) {
    return new CalendarController($app);
});

// Register routes
$app->get('/', 'welcome.controller:helloAction')->bind('homepage');
$app->get('/calendar', 'calendar.controller:indexAction');
$app->post('/feedback', '');

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