<?php

namespace Malendar\Tests\Domain\Model;

use Malendar\Domain\Model\User\Exception\UserValidationException;
use Malendar\Domain\Model\User\User;
use Malendar\Domain\Model\ValueObject\Email;

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
