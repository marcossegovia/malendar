<?php


namespace Malendar\Domain\Entities\Calendar;


use Malendar\Domain\Entities\Course\Course;
use Malendar\Domain\Entities\ValueObject\UuId;

class Calendar
{
    /**
     * @var UuId
     */
    private $id;

    /**
     * @var Course
     */
    private $course;
}