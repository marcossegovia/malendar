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
        $app = require __DIR__ . '/../../../app/app.php';
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);
        $this->assertInstanceOf('Malendar\Domain\Entities\ValueObject\UserId', $repository->nextIdentity());
    }

    public function testUserPersistance()
    {
        $app = require __DIR__ . '/../../../app/app.php';
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userId = $repository->nextIdentity();
        $user = new User($userId, 'Pablo', new Email('pablo@gmail.com'), '12745');
        $repository->add($user);

        $user = $em->find('Malendar\Domain\Entities\User\User', $userId->toString());
        $this->assertTrue(count($user) == 1);

        $em->remove($user);
        $em->remove($userId);
        $em->flush();
    }

    public function testAllUsersAreFound()
    {
        $app = require __DIR__ . '/../../../app/app.php';
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userId1 = $repository->nextIdentity();
        $user1 = new User($userId1, 'Marcos', new Email('marcos@gmail.com'), '1234');
        $repository->add($user1);
        $userId2 = $repository->nextIdentity();
        $user2 = new User($userId2, 'David', new Email('david@gmail.com'), '5678');
        $repository->add($user2);

        $users = $repository->findAll();
        $this->assertTrue(count($users) == 2);

        $em->remove($user1);
        $em->remove($userId1);
        $em->remove($user2);
        $em->remove($userId2);
        $em->flush();
    }

    public function testAddingUser()
    {
        $app = require __DIR__ . '/../../../app/app.php';
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userId = $repository->nextIdentity();
        $user = new User($userId, 'Juan', new Email('juan@gmail.com'), 'juanito123');

        $repository->add($user);

        $user = $em->find('Malendar\Domain\Entities\User\User', $userId->toString());
        $this->assertTrue(count($user) == 1);

        $em->remove($user);
        $em->remove($userId);
        $em->flush();
    }

    public function testFindUserByEmail()
    {
        $app = require __DIR__ . '/../../../app/app.php';
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userId = $repository->nextIdentity();
        $userSent = new User($userId, 'troll', new Email('troll@gmail.com'), 'troll123');

        $repository->add($userSent);
        $userReceived = $repository->findByEmail(new Email('troll@gmail.com'));
        $this->assertTrue($userSent->equals($userReceived));

        $em->remove($userSent);
        $em->remove($userId);
        $em->flush();

    }

    public function testFindeUserByUsername()
    {
        $app = require __DIR__ . '/../../../app/app.php';
        $em = $app['orm.em'];
        $repository = new UserCaseRepository($em);

        $userId = $repository->nextIdentity();
        $userSent = new User($userId, 'genius', new Email('genius@gmail.com'), 'genius123');

        $repository->add($userSent);
        $userReceived = $repository->findByUsername('Marcos');
        $this->assertTrue($userSent->equals($userReceived));

        $em->remove($userSent);
        $em->remove($userId);
        $em->flush();
    }


    /* public function testRemoveUser()
     {
         $app = require __DIR__ . '/../../../app/app.php';
         $em = $app['orm.em'];
         $repository = new UserCaseRepository($em);

         $userId = $repository->nextIdentity();
         $userSent = new User($userId, 'Marcosss', new Email('marcos@gmail.com'), 'marcos123');

         $repository->add($userSent);
         $user1 = $repository->findByEmail(new Email('marcos@gmail.com'));
         var_dump($user1);
         $this->assertTrue(isset($user1));

         $repository->remove($userSent);

         $user2 = $repository->findByEmail(new Email('marcos@gmail.com'));
         var_dump($user2);
         $this->assertFalse(isset($user2));

         $em->remove($userSent);
         $em->remove($userId);
         $em->flush();
     }*/

}
