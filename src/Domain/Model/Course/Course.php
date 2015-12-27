<?php

namespace Malendar\Domain\Model\Course;

use Malendar\Domain\Model\Calendar\Calendar;
use Malendar\Domain\Model\Master\Master;
use Malendar\Domain\Model\ValueObject\UuId;

class Course
{
	/**
	 * @var UuId
	 */
	private $id;

	/**
	 * @var \Datetime
	 */
	private $date_start;

	/**
	 * @var \Datetime
	 */
	private $date_end;

	/**
	 * @var array
	 */
	private $class_days;

	/**
	 * @var Master
	 */
	private $master;

	/**
	 * @var Calendar
	 */
	private $calendar;

	public function __construct()
	{

	}
}