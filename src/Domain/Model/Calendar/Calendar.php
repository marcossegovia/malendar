<?php

namespace Malendar\Domain\Model\Calendar;

use Malendar\Domain\Model\Course\Course;
use Malendar\Domain\Model\ValueObject\UuId;

class Calendar
{
	/** @var UuId */
	private $id;

	/** @var  Course */
	private $course;

	/** @var  Event[] */
	private $events;

	public function __construct(Uuid $id)
	{
		$this->id = $id;
	}

	public function id()
	{
		return $this->id;
	}

	public static function create()
	{
		$id = UuId::generate();

		return new self( $id );
	}
}