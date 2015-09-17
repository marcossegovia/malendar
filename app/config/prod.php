<?php

// configure your app for the production environment

$app['twig.path'] = array(__DIR__.'/../../src/templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

// Add the routing
require __DIR__ . '/routing.php';
