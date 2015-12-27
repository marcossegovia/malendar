<?php

namespace Malendar\Domain\Model\ValueObject;

final class UuId
{
	/** @var  string */
	private $id;

	public function __construct($raw_id)
	{
		$this->id = $raw_id;
	}

	public static function generate()
	{
		return new self( \Rhumsaa\Uuid\Uuid::uuid4()->toString() );
	}

	public function toString()
	{
		return $this->id;
	}

	public function equals(UuId $a_uiId)
	{
		return $this->rawId() === $a_uiId->rawId();
	}

	public function rawId()
	{
		return $this->id;
	}
}