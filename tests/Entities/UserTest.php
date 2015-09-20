<?php


namespace Malendar\Tests\Entities;

use Malendar\Entities\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testUserHasFields()
    {
        $user = new User('Pablo', 'pablo@gmail.com', '1234');
        $this->assertEquals('Pablo', $user->getName());
        $this->assertEquals('pablo@gmail.com', $user->getEmail());
        $this->assertEquals('1234', $user->getPassword());
    }

    public function testUserValidatePassword()
    {
        $user = new User('Pablo', 'pablo@gmail.com', '1234');
        $this->assertTrue($user->validate('1234'));
    }
}
