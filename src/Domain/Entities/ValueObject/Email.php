<?php


namespace Malendar\Domain\Entities\ValueObject;

use Silex\Application;
use Symfony\Component\Validator\Constraints as ValidatorAssert;

final class Email
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function validate(Application $app)
    {
        return count($app['validator']->validateValue($this->email, new ValidatorAssert\Email())) == 0 ? true : false;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->email;
    }

    public function equals(Email $email)
    {
        return strcmp($this->getEmail(), $email->getEmail()) == 0;
    }

    public function getEmail()
    {
        return $this->email;
    }
}