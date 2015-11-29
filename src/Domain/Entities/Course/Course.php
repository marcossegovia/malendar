<?php


namespace Malendar\Domain\Entities\Course;


use Malendar\Domain\Entities\Calendar\Calendar;
use Malendar\Domain\Entities\Master\Master;
use Malendar\Domain\Entities\ValueObject\UuId;


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