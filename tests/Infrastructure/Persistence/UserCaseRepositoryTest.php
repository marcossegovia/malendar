<?php

namespace Malendar\Tests\Infrastructure\Persistence;

use Malendar\Infrastructure\Factory\EmailFactory;
use Malendar\Infrastructure\Factory\UserFactory;
use Malendar\Infrastructure\Factory\UserIdFactory;
use Silex\Application;

class UserCaseRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testNextUserIdReturnsUserId()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];
        $this->assertInstanceOf('Malendar\Domain\Entities\ValueObject\UserId', UserIdFactory::create());
    }

    public function testUserPersistance()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];
        $user = UserFactory::create(UserIdFactory::create(), 'Pablo', EmailFactory::create('pablo@gmail.com'), '12745');
        $repository->add($user);

        $user = $repository->find($user->getUserId());
        $this->assertTrue(count($user) == 1);

        $repository->remove($user);
    }

    public function testAllUsersAreFound()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];

        $user1 = UserFactory::create(UserIdFactory::create(), 'Marcos', EmailFactory::create('marcos@gmail.com'), '1234');
        $repository->add($user1);
        $user2 = UserFactory::create(UserIdFactory::create(), 'David', EmailFactory::create('david@gmail.com'), '5678');
        $repository->add($user2);

        $users = $repository->findAll();
        $this->assertTrue(count($users) >= 2);

        $repository->remove($user1);
        $repository->remove($user2);
    }

    public function testAddingUser()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];

        $userId = UserIdFactory::create();

        $user = UserFactory::create($userId, 'Juan', EmailFactory::create('juan@gmail.com'), 'juanito123');

        $repository->add($user);

        $user = $repository->find($userId);
        $this->assertTrue(count($user) == 1);

        $repository->remove($user);
    }

    public function testFindUserByEmail()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];

        $userSent = UserFactory::create(UserIdFactory::create(), 'troll', EmailFactory::create('troll@gmail.com'), 'troll123');

        $repository->add($userSent);

        $userReceived = $repository->findByEmail(EmailFactory::create('troll@gmail.com'));
        $this->assertTrue($userSent->equals($userReceived));

        $repository->remove($userSent);

    }

    public function testFindUserByUsername()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];

        $userSent = UserFactory::create(UserIdFactory::create(), 'genius', EmailFactory::create('genius@gmail.com'), 'genius123');

        $repository->add($userSent);

        $userReceived = $repository->findByUsername('genius');
        $this->assertTrue($userSent->equals($userReceived));

        $repository->remove($userSent);
    }


    public function testRemoveUser()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];

        $userSent = UserFactory::create(UserIdFactory::create(), 'Paco', EmailFactory::create('paco@gmail.com'), 'paco123');

        $repository->add($userSent);

        $user1 = $repository->findByEmail(EmailFactory::create('paco@gmail.com'));
        $this->assertFalse(empty($user1));

        $repository->remove($userSent);

        $user2 = $repository->findByEmail(EmailFactory::create('paco@gmail.com'));
        $this->assertTrue(empty($user2));
    }

    public function testUpdateUser()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $repository = $app['user_repository'];

        $userSent = UserFactory::create(UserIdFactory::create(), 'Marcos', EmailFactory::create('marcos@gmail.com'), 'marcos123');

        $repository->add($userSent);

        $userSent->setPassword('marcos321');
        $userSent->setUsername('Marcos-Je');
        $repository->update();

        $userReceived = $repository->findByUsername('Marcos-Je');

        $this->assertTrue($userSent->equals($userReceived));

        $repository->remove($userSent);
    }

}
