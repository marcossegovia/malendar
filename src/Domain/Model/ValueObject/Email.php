<?php

namespace Malendar\Domain\Model\ValueObject;

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
		return new self( $a_raw_email );
	}

	public function validate()
	{
		if (!filter_var( $this->email, FILTER_VALIDATE_EMAIL ))
		{
			throw new \InvalidArgumentException( 'This is a not valid Email.' );
		}
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