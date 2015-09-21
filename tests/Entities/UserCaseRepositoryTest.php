<?php

namespace Malendar\Tests\Entities;

use Malendar\Infrastructure\Persistence\UserCaseRepository;

class UserCaseRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testNextUserIdReturnsUserId()
    {
        $repository = new UserCaseRepository();
        $this->assertInstanceOf('Malendar\Domain\Entities\ValueObject\UserId', $repository->nextIdentity());
    }
}
