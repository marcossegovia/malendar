<?php

namespace Malendar\Tests\Domain\Entities;

use Malendar\Domain\Entities\User\Exception\UserValidationException;
use Malendar\Infrastructure\Factory\EmailFactory;
use Malendar\Infrastructure\Factory\UserFactory;
use Malendar\Infrastructure\Factory\UuIdFactory;
use Silex\Application;
use Silex\Provider\ValidatorServiceProvider;

class UserTest extends \PHPUnit_Framework_TestCase
{
	public function testUserHasFields()
	{
		$email = EmailFactory::create( 'pablo@gmail.com' );
		$user  = UserFactory::create( UuIdFactory::create(), 'Pablo', $email, FALSE, '1234' );
		$this->assertEquals( 'Pablo', $user->name() );
		$this->assertEquals( 'pablo@gmail.com', $user->email() );
	}

	public function testUserThrowExceptionsWhenValidatationGoWrong()
	{
		$email = EmailFactory::create( 'pablo@gmail.com' );
		$user  = UserFactory::create( UuIdFactory::create(), 'Pablo', $email, FALSE, '1234' );
		$this->setExpectedException(UserValidationException::class, 'The user and password provided do not match.');
		$user->validate( '4321' );
	}
}
