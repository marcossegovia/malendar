<?php


namespace Malendar\Domain\Entities\ValueObject;

use Rhumsaa\Uuid\Uuid;

final class UserId
{
    private $id;
    private $user_id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->id->toString();
    }

    public function equals(UserId $userId)
    {

    }
}