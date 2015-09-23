<?php

namespace Malendar\Tests\Infrastructure\Persistence;

use Malendar\Infrastructure\Persistence\UserCaseRepository;
use Silex\Application;

class UserCaseRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testNextUserIdReturnsUserId()
    {
        $repository = new UserCaseRepository();
        $this->assertInstanceOf('Malendar\Domain\Entities\ValueObject\UserId', $repository->nextIdentity());
    }
}
