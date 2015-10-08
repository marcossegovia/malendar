<?php

namespace Malendar\Infrastructure\Ui\Silex;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

class Application
{
    public static function boostrap()
    {
        $app = new \Silex\Application();

        //Providers
        $app->register(new UrlGeneratorServiceProvider());
        $app->register(new ValidatorServiceProvider());
        $app->register(new ServiceControllerServiceProvider());
        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__ . '/../../../../src/Application/Resources/Templates',
            'twig.options' => array('cache' => __DIR__ . '/../../../../app/var/cache/twig')
        ));
        $app->register(new SessionServiceProvider());

        $app->register(new DoctrineServiceProvider(), array(
            'db.options' => array(
                'driver' => 'pdo_mysql',
                'dbname' => 'world',
                'host' => 'localhost',
                'user' => 'root',
                'password' => 'root',
                'charset' => 'utf8',
            )
        ));

        $app->register(new DoctrineOrmServiceProvider, array(
            "orm.proxies_dir" => __DIR__ . "/var/cache/doctrine/proxy",
            "orm.em.options" => array(
                "mappings" => array(
                    array(
                        'type' => 'yml',
                        'namespace' => 'Malendar\\Domain\\Entities\\',
                        'path' => __DIR__ . "/../../../../src/Application/Resources/config/yaml/",
                    ),
                ),
            ),
        ));

        //Services


        $app['user_repository'] = $app->share(function ($app) {
            return $app['orm.em']->getRepository('Malendar\Domain\Entities\User\User');
        });

        $app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {

            return $twig;
        })
        );

        return $app;


    }
}

