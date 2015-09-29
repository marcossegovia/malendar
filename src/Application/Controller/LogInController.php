<?php

namespace Malendar\Application\Controller;

use Symfony\Component\HttpFoundation\Response;

class LogInController
{
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function helloAction()
    {
        return $this->twig->render('login.html');
    }
}