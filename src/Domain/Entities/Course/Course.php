<?php


namespace Malendar\Domain\Entities\Course;


class Course
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Datetime
     */
    private $date_start;

    /**
     * @var Datetime
     */
    private $date_end;

    /**
     * @var array
     */
    private $class_days;

    private $master;

    public function __construct()
    {

    }
}