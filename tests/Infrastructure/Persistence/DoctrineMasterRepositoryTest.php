<?php


namespace Malendar\Tests\Infrastructure\Persistence;


use DateTime;
use Malendar\Infrastructure\Factory\MasterFactory;
use Malendar\Infrastructure\Factory\UuIdFactory;

class DoctrineMasterRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testMasterIsPersisted()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['master_repository'];
        $master = MasterFactory::create(UuIdFactory::create(), 'Master en Programación Web', 'MPWAR',
            'Este master va orientado para los super web developers', new DateTime('NOW'));
        //$repository->add($master);
    }
}
