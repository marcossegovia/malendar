<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
//use Palma\Silex\Provider\DoctrineORMServiceProvider;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());

// Doctrine

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
            'driver'   => 'pdo_mysql',
            'dbname'   => 'world',
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => 'root',
            'charset'  => 'utf8',
    )
));

$app->register(new DoctrineOrmServiceProvider, array(
    "orm.proxies_dir" => __DIR__ . "/var/cache/doctrine/proxy",
    "orm.em.options" => array(
        "mappings" => array(
            array(
                'type' => 'yml',
                'namespace' => 'Malendar\Domain\Entities\\',
                'path' => __DIR__ . "/../src/Application/Resources/config/yaml/",
            ),
        ),
    ),
));


$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
}));

return $app;
