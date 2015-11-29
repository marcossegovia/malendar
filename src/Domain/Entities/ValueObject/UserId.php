<?php


namespace Malendar\Domain\Entities\ValueObject;

use Rhumsaa\Uuid\Uuid;

final class UserId
{
    private $uuid;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }

    public function __toString()
    {
        return $this->uuid->toString();
    }

    public function toString()
    {
        return $this->uuid->toString();
    }

    public function equals(UserId $userId)
    {
        return strcmp($this->getUserId(), $userId->getUserId()) == 0;
    }

    public function getUserId()
    {
        return $this->uuid;
    }
}