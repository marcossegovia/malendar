<?php

namespace Malendar\Domain\Entities\User;

use Doctrine\Common\Collections\ArrayCollection;
use Malendar\Domain\Entities\Master\Master;
use Malendar\Domain\Entities\User\Exception\UserValidationException;
use Malendar\Domain\Entities\ValueObject\UuId;
use Malendar\Domain\Entities\ValueObject\Email;

class User
{
	/**
	 * @var UuId
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var Email
	 */
	private $email;

	/**
	 * @var string
	 */
	private $hashCode;

	/**
	 * @var boolean
	 */
	private $admin;

	/**
	 * @var array
	 */
	private $masters;

	public function __construct(UuId $uuid, $name, Email $email, $admin = FALSE, $password = NULL, $hashCode = NULL)
	{
		$this->id      = $uuid;
		$this->name    = $name;
		$this->email   = $email;
		$this->admin   = $admin;
		$this->masters = new ArrayCollection();

		if ($password === NULL)
		{
			$this->hashCode = $hashCode;
		}
		else
		{
			$salt           = strtr( base64_encode( mcrypt_create_iv( 16, MCRYPT_DEV_URANDOM ) ), '+', '.' );
			$salt           = "$3a$10$" . $salt;
			$this->hashCode = crypt( $password, $salt );
		}

	}

	public function getName()
	{
		return $this->name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getHashCode()
	{
		return $this->hashCode;
	}

	public function validate($password)
	{
		if (!hash_equals( $this->hashCode, crypt( $password, $this->hashCode ) ))
		{
			throw new UserValidationException();
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function equals(User $user)
	{
		return $this->id->equals( $user->getId() );
	}

	public function setPassword($password)
	{
		$salt           = strtr( base64_encode( mcrypt_create_iv( 16, MCRYPT_DEV_URANDOM ) ), '+', '.' );
		$salt           = "$3a$10$" . $salt;
		$this->hashCode = crypt( $password, $salt );
	}

	public function setUsername($username)
	{
		$this->name = $username;
	}

	public function isAdmin()
	{
		return $this->admin;
	}

	public function getMastersCollection(UserRepositoryInterface $repository)
	{

	}

	public function getMasters()
	{
		return $this->masters;
	}

	public function addMaster(Master $master)
	{
		$this->masters->add( $master );
	}
}