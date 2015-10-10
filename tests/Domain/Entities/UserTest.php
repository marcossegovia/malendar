<?php


namespace Malendar\Tests\Domain\Entities;

use Malendar\Infrastructure\Factory\EmailFactory;
use Malendar\Infrastructure\Factory\UserFactory;
use Malendar\Infrastructure\Factory\UserIdFactory;
use Silex\Application;
use Silex\Provider\ValidatorServiceProvider;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testUserHasFields()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];
        $email = EmailFactory::create('pablo@gmail.com');
        $user = UserFactory::create(UserIdFactory::create(), 'Pablo', $email, '1234');
        $this->assertEquals('Pablo', $user->getName());
        $this->assertEquals('pablo@gmail.com', $user->getEmail());
    }

    public function testUserValidatePassword()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];
        $email = EmailFactory::create('pablo@gmail.com');
        $user = UserFactory::create(UserIdFactory::create(), 'Pablo', $email, '1234');
        $this->assertTrue($user->validate('1234'));
    }

    public function testEmailIsValid()
    {
        $app = new Application();
        $app->register(new ValidatorServiceProvider());
        $email = EmailFactory::create('pablo@gmail.com');
        $this->assertTrue($email->validate($app));
    }
}
