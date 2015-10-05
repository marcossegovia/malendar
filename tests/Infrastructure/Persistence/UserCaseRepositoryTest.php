<?php

namespace Malendar\Tests\Infrastructure\Persistence;

use Malendar\Infrastructure\Persistence\UserCaseRepository;
use Silex\Application;
use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Domain\Entities\User\User;

class UserCaseRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testNextUserIdReturnsUserId()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);
        $this->assertInstanceOf('Malendar\Domain\Entities\ValueObject\UserId', $repository->nextIdentity());
    }

    public function testUserPersistance()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $user = new User($repository->nextIdentity(), 'Pablo', new Email('pablo@gmail.com'), '12745');
        $repository->add($user);

        $user = $em->find('Malendar\Domain\Entities\User\User', $user->getUserId());
        $this->assertTrue(count($user) == 1);

        $repository->remove($user);
    }

    public function testAllUsersAreFound()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $user1 = new User($repository->nextIdentity(), 'Marcos', new Email('marcos@gmail.com'), '1234');
        $repository->add($user1);
        $user2 = new User($repository->nextIdentity(), 'David', new Email('david@gmail.com'), '5678');
        $repository->add($user2);

        $users = $repository->findAll();
        $this->assertTrue(count($users) >= 2);

        $repository->remove($user1);
        $repository->remove($user2);
    }

    public function testAddingUser()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userId = $repository->nextIdentity();
        $user = new User($userId, 'Juan', new Email('juan@gmail.com'), 'juanito123');

        $repository->add($user);

        $user = $em->find('Malendar\Domain\Entities\User\User', $userId);
        $this->assertTrue(count($user) == 1);

        $repository->remove($user);
    }

    public function testFindUserByEmail()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userSent = new User($repository->nextIdentity(), 'troll', new Email('troll@gmail.com'), 'troll123');

        $repository->add($userSent);

        $userReceived = $repository->findByEmail(new Email('troll@gmail.com'));
        $this->assertTrue($userSent->equals($userReceived));

        $repository->remove($userSent);

    }

    public function testFindUserByUsername()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userSent = new User($repository->nextIdentity(), 'genius', new Email('genius@gmail.com'), 'genius123');

        $repository->add($userSent);

        $userReceived = $repository->findByUsername('genius');
        $this->assertTrue($userSent->equals($userReceived));

        $repository->remove($userSent);
    }


    public function testRemoveUser()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userSent = new User($repository->nextIdentity(), 'Paco', new Email('paco@gmail.com'), 'paco123');

        $repository->add($userSent);

        $user1 = $repository->findByEmail(new Email('paco@gmail.com'));
        $this->assertFalse(empty($user1));

        $repository->remove($userSent);

        $user2 = $repository->findByEmail(new Email('paco@gmail.com'));
        $this->assertTrue(empty($user2));
    }

    public function testUpdateUser()
    {
        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userSent = new User($repository->nextIdentity(), 'Marcos', new Email('marcos@gmail.com'), 'marcos123');

        $repository->add($userSent);

        $userSent->setPassword('marcos321');
        $userSent->setUsername('Marcos-Je');
        $repository->update();

        $userReceived = $repository->findByUsername('Marcos-Je');

        $this->assertTrue($userSent->equals($userReceived));

        $repository->remove($userSent);
    }

}
