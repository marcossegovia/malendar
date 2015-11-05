<?php


namespace Malendar\Domain\Entities\User;


use Malendar\Domain\Entities\ValueObject\UserId;
use Malendar\Domain\Entities\ValueObject\Email;


class User
{
    /**
     * @var UserId
     */
    private $uuid;

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


    public function __construct(UserId $uuid, $name, Email $email, $password = null, $hashCode = null)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->email = $email;

        if ($password == null) {
            $this->hashCode = $hashCode;
        } else {
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
            $salt = "$3a$10$" . $salt;
            $this->hashCode = crypt($password, $salt);
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
        return hash_equals($this->hashCode, crypt($password, $this->hashCode));
    }

    public function getUserId()
    {
        return $this->uuid;
    }

    public function equals(User $user)
    {
        return $this->uuid->equals($user->getUserId());
    }

    public function setPassword($password)
    {
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $salt = "$3a$10$" . $salt;
        $this->hashCode = crypt($password, $salt);
    }

    public function setUsername($username)
    {
        $this->name = $username;
    }
}