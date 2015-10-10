<?php

namespace Malendar\Tests\Application;

use Silex\WebTestCase;

class RequestApplicationRoutesTest extends WebTestCase
{
    public function createApplication()
    {
        // TODO: Implement createApplication() method.
        require __DIR__ . '/../../app/silex/index.php';
        $app['debug'] = true;
        $app['session.test'] = true;
        unset($app['exception_handler']);

        return $app;
    }

    public function testHello()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertTrue($crawler->filter('form')->count() > 0);
    }


}