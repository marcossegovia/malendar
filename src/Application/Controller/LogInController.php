<?php

namespace Malendar\Application\Controller;

use Malendar\Infrastructure\Persistence\UserCaseRepository;
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
        return new Response($this->app['twig']->render('login.html', ['formError' => false]), 200);
    }

    public function processLoginAction()
    {
        $userName = $this->app['request']->get('user');
        $password = $this->app['request']->get('password');
        $userRepository = new UserCaseRepository($this->app['orm.em']);
        $user = $userRepository->findByUsername($userName);
        if (!empty($user) && $user->validate($password)) {
            return $this->app->redirect($this->app["url_generator"]->generate("calendar"));
        } else {
            return new Response($this->app['twig']->render('login.html', ['formError' => true]), 201);
        }
    }
}