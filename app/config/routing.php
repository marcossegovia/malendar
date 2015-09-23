<?php

use Malendar\Application\Controller\WelcomeController;

// Register Controllers and their dependencies
$app['welcome.controller'] = $app->share(function () use ($app) {
    return new WelcomeController($app['twig']);
});

// Register routes
$app->get('/', 'welcome.controller:helloAction')->bind('homepage');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/' . $code . '.html',
        'errors/' . substr($code, 0, 2) . 'x.html',
        'errors/' . substr($code, 0, 1) . 'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});