<?php


namespace Malendar\Tests\Domain\Entities;

use Malendar\Domain\Entities\User\User;
use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Infrastructure\Persistence\UserCaseRepository;
use Silex\Application;
use Silex\Provider\ValidatorServiceProvider;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testUserHasFields()
    {
        $repository = new UserCaseRepository();
        $email = new Email('pablo@gmail.com');
        $user = new User($repository->nextIdentity(), 'Pablo', $email, '1234');
        $this->assertEquals('Pablo', $user->getName());
        $this->assertEquals('pablo@gmail.com', $user->getEmail());
    }

    public function testUserValidatePassword()
    {
        $repository = new UserCaseRepository();
        $email = new Email('pablo@gmail.com');
        $user = new User($repository->nextIdentity(), 'Pablo', $email, '1234');
        $this->assertTrue($user->validate('1234'));
    }

    public function testEmailIsValid()
    {
        $app = new Application();
        $app->register(new ValidatorServiceProvider());
        $email = new Email('pablo@gmail.com');
        $this->assertTrue($email->validate($app));
    }
}
