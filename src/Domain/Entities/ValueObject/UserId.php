<?php


namespace Malendar\Domain\Entities\ValueObject;

use Rhumsaa\Uuid\Uuid;

final class UserId
{
    private $id;
    private $user_id;

    public function __construct()
    {
        $this->user_id = Uuid::uuid4();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->user_id->toString();
    }

    public function equals(UserId $userId)
    {

    }
}