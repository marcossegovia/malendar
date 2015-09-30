<?php


namespace Malendar\Application\Controller;

use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

class CalendarController
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function indexAction()
    {
        return $this->app['twig']->render('calendar.html');
    }
}