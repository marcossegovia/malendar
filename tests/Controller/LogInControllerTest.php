<?php

namespace Malendar\Tests\Controller;

use Malendar\Application\Controller\WelcomeController;
use Silex\WebTestCase;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class LogInControllerTest extends WebTestCase
{
    public function createApplication()
    {
        // TODO: Implement createApplication() method.
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        require __DIR__ . '/../../app/config/prod.php';
        $app['debug'] = true;
        $app['session.test'] = true;
        unset($app['exception_handler']);

        return $app;
    }

    public function testHello()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertTrue($crawler->filter('form')->count() > 0);
    }


}