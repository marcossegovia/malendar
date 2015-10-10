<?php

namespace Malendar\Tests\Application\Service;

use Malendar\Application\Service\User\LoginUserService;
use Malendar\Domain\Entities\User\User;
use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Infrastructure\Factory\UserFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class LoginUserServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testUserHasLogged()
    {
        /*$app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $app['session.test'] = true;
        $loginService = new LoginUserService($app['user_repository'], $app['session']);
        $id = $app['user_repository']->nextIdentity();
        $user = UserFactory::create($id, 'Auron', new Email('auron@gmail.com'), '1234');
        $app['user_repository']->add($user);

        $loginService->execute(Request::create('POST', '/login', array('form' => array('user' => 'Auron', 'password' => '1234'))));

        //$app['session']->set('id', $user->getUserId());
        //var_dump($app['session']);
        $this->assertEquals($id, $app['session']->get('id'));

        $app['user_repository']->remove($user);*/
    }
}
