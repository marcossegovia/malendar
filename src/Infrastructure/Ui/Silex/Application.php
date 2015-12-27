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
		//$app['debug'] = true;
		//Providers
		$app->register( new UrlGeneratorServiceProvider() );
		$app->register( new ValidatorServiceProvider() );
		$app->register( new ServiceControllerServiceProvider() );
		$app->register( new TwigServiceProvider(), array(
													 'twig.path'    => __DIR__ . '/../../../../app/silex/Templates',
													 'twig.options' => array(
														 'cache' => __DIR__ . '/../../../../app/var/cache/twig',
														 'debug' => 'true'
													 )
												 )
		);
		$app->register( new SessionServiceProvider() );

		$app->register( new DoctrineServiceProvider(), array(
														 'db.options' => array(
															 'driver'   => 'pdo_mysql',
															 'dbname'   => 'world',
															 'host'     => 'localhost',
															 'user'     => 'root',
															 'password' => 'root',
															 'charset'  => 'utf8',
														 )
													 )
		);

		$app->register( new DoctrineOrmServiceProvider, array(
														  "orm.proxies_dir" => __DIR__ . "/var/cache/doctrine/proxy",
														  "orm.em.options"  => array(
															  "mappings" => array(
																  array(
																	  'type'      => 'yml',
																	  'namespace' => 'Malendar\\Domain\\Model\\',
																	  'path'      => __DIR__ . "/../../../../app/config/doctrine/",
																  ),
															  ),
														  ),
													  )
		);

		//Repositories

		$app['user_repository'] = $app->share( function ($app)
		{
			return $app['orm.em']->getRepository( 'Malendar\Domain\Entities\User\User' );
		}
		);

		$app['master_repository'] = $app->share( function ($app)
		{
			return $app['orm.em']->getRepository( 'Malendar\Domain\Entities\Master\Master' );
		}
		);

		$app['twig'] = $app->share( $app->extend( 'twig', function ($twig, $app)
		{

			return $twig;
		}
		)
		);

		return $app;

	}
}

