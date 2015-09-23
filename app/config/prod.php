<?php

// configure your app for the production environment

$app['twig.path'] = array(__DIR__.'/../../src/Application/Resources/Templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

// Add the routing
require __DIR__ . '/routing.php';
