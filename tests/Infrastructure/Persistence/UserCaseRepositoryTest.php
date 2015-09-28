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
        $repository = new UserCaseRepository();
        $this->assertInstanceOf('Malendar\Domain\Entities\ValueObject\UserId', $repository->nextIdentity());
    }

    public function testUserPersistance()
    {
        $app = require __DIR__.'/../../../app/app.php';
        $em = $app['orm.em'];
        $repository = new UserCaseRepository();
        $email = new Email('pablo@gmail.com');
        $userId = $repository->nextIdentity();
        $user = new User($userId, 'Pablo', $email, '1245');
        $em->persist($user);
        $em->persist($userId);
        $em->flush();

        $this->assertTrue(true);
    }
}
