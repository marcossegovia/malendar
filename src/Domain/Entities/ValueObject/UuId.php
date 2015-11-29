<?php


namespace Malendar\Domain\Entities\ValueObject;

final class UuId
{
    private $id;

    public function __construct()
    {
        $this->id = \Rhumsaa\Uuid\Uuid::uuid4();
    }

    public function __toString()
    {
        return $this->id->toString();
    }

    public function toString()
    {
        return $this->id->toString();
    }

    public function equals(UuId $userId)
    {
        return strcmp($this->getUserId(), $userId->getUserId()) == 0;
    }

    public function getUserId()
    {
        return $this->id;
    }
}