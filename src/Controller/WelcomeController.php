<?php

namespace Malendar\Controller;

use Symfony\Component\HttpFoundation\Response;

class WelcomeController
{
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function helloAction()
    {
        phpinfo();
        return $this->twig->render('index.html');
    }
}