<?php


namespace Malendar\Domain\Entities\Calendar;

use Malendar\Domain\Entities\Course\Course;
use Malendar\Domain\Entities\ValueObject\UuId;
use Malendar\Infrastructure\Factory\UuIdFactory;

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
        $id = UuIdFactory::create();
        return new self($id);
    }
}