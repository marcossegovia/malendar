<?php

namespace Malendar\Domain\Entities\ValueObject;

use Silex\Application;
use Symfony\Component\Validator\Constraints as ValidatorAssert;

final class Email
{
	/** @var  string */
	private $email;

	public function __construct($email)
	{
		$this->email = $email;
	}

	public static function build($a_raw_email)
	{
		return new self($a_raw_email);
	}

	public function validate(Application $app)
	{
		return count( $app['validator']->validateValue( $this->email, new ValidatorAssert\Email() )
		) == 0 ? TRUE : FALSE;
	}

	public function __toString()
	{
		return $this->email;
	}

	public function equals(Email $email)
	{
		return $this->getEmail() === $email->getEmail();
	}

	public function getEmail()
	{
		return $this->email;
	}
}