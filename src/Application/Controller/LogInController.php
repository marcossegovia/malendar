<?php

namespace Malendar\Application\Controller;

use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

class LogInController
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function helloAction()
    {
        return new Response($this->app['twig']->render('login.html'), 200);
    }

    public function processLoginAction()
    {
        return new Response($this->app['twig']->render('calendar.html'), 201);
    }
}