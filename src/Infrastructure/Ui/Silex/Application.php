<?php

namespace Malendar\Infrastructure\Ui\Silex;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SimpleBus\Message\CallableResolver\CallableMap;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;

class Application
{
    public static function boostrap()
    {
        $app = new \Silex\Application();
        //$app['debug'] = true;
        //Providers
        $app->register(new UrlGeneratorServiceProvider());
        $app->register(new ValidatorServiceProvider());
        $app->register(new ServiceControllerServiceProvider());
        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__ . '/../../../../app/silex/Templates',
            'twig.options' => array('cache' => __DIR__ . '/../../../../app/var/cache/twig', 'debug' => 'true')
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
                        'path' => __DIR__ . "/../../../../app/config/doctrine/",
                    ),
                ),
            ),
        ));

        //Repositories

        $app['user_repository'] = $app->share(function ($app) {
            return $app['orm.em']->getRepository('Malendar\Domain\Entities\User\User');
        });

        $app['master_repository'] = $app->share(function ($app){
           return $app['orm.em']->getRepository('Malendar\Domain\Entities\Master\Master');
        });


        //Commands/Handlers

        $app['LoginUserCommandHandler'] = $app->share(function ($app) {
            return new \Malendar\Application\User\LoginUserCommandHandler($app['user_repository'], $app['session']);
        });

        $app['commandBus'] = $app->share(function ($app){

            //Instantiation of CommandBus
            $commandBus = new MessageBusSupportingMiddleware();
            //Commands are always fully handled before other commands will be handled
            $commandBus->appendMiddleware(new FinishesHandlingMessageBeforeHandlingNext());

            $commandHandlersByCommandName = [
                // the "command_handler_service_id" service will be resolved when needed (see below)
                'Malendar\Application\User\LoginUserCommand' => ['LoginUserCommandHandler', 'handle']
            ];

            $serviceLocator = function ($serviceId) use ($app) {
                return $app[$serviceId];
            };

            $commandHandlerMap = new CallableMap(
                $commandHandlersByCommandName,
                new ServiceLocatorAwareCallableResolver($serviceLocator)
            );

            $commandNameResolver = new ClassBasedNameResolver();

            $commandHandlerResolver = new NameBasedMessageHandlerResolver(
                $commandNameResolver,
                $commandHandlerMap
            );

            // We append to our CommandBus the resolver in order to attach Command to CommandHandler
            $commandBus->appendMiddleware(
                new DelegatesToMessageHandlerMiddleware(
                    $commandHandlerResolver
                )
            );

            return $commandBus;
        });

        $app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {

            return $twig;
        })
        );

        return $app;


    }
}

