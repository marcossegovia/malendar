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

	public function __construct(UuId $a_uuid, $a_name, Email $an_email, $a_hashCode, $an_is_admin)
	{
		$this->id      = $a_uuid;
		$this->name    = $a_name;
		$this->email   = $an_email;
		$this->hashCode = $a_hashCode;
		$this->admin   = $an_is_admin;
		$this->masters = new ArrayCollection();

	}

	public static function register($a_name, $a_password, $an_email, $an_is_admin)
	{
		$id       = Uuid::generate();
		$name     = $a_name;
		$email    = $an_email;
		$salt     = strtr( base64_encode( mcrypt_create_iv( 16, MCRYPT_DEV_URANDOM ) ), '+', '.' );
		$salt     = "$3a$10$" . $salt;
		$hascode  = crypt( $a_password, $salt );
		$is_admin = $an_is_admin;

		return new self($id, $name, $email, $hascode, $is_admin);
	}

	public function id()
	{
		return $this->id;
	}

	public function name()
	{
		return $this->name;
	}

	public function email()
	{
		return $this->email;
	}

	public function hashCode()
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

	public function equals(User $user)
	{
		return $this->id->equals( $user->id() );
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