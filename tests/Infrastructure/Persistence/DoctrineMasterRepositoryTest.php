<?php


namespace Malendar\Tests\Infrastructure\Persistence;


class DoctrineMasterRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testMasterIsPersisted()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['master_repository'];


    }
}
