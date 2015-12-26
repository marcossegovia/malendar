<?php

namespace Malendar\Tests\Domain\Entities;

use Malendar\Domain\Entities\User\Exception\UserValidationException;
use Malendar\Domain\Entities\User\User;
use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Domain\Entities\ValueObject\UuId;
use Malendar\Infrastructure\Factory\EmailFactory;
use Malendar\Infrastructure\Factory\UserFactory;
use Malendar\Infrastructure\Factory\UuIdFactory;
use Silex\Application;
use Silex\Provider\ValidatorServiceProvider;

class UserTest extends \PHPUnit_Framework_TestCase
{
	public function testUserHasFields()
	{
		$email = Email::build( 'pablo@gmail.com' );
		$user  = User::register( 'Pablo', '1234', $email, FALSE );
		$this->assertEquals( 'Pablo', $user->name() );
		$this->assertEquals( 'pablo@gmail.com', $user->email() );
	}

	public function testUserThrowExceptionsWhenValidatationGoWrong()
	{
		$email = Email::build( 'pablo@gmail.com' );
		$user  = User::register( 'Pablo', '1234', $email, FALSE );
		$this->setExpectedException( UserValidationException::class, 'The user and password provided do not match.' );
		$user->validate( '4321' );
	}
}
