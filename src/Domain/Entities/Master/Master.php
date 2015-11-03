<?php


namespace Malendar\Domain\Entities\Master;


class Master
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $acronym;

    /**
     * @var text
     */
    private $description;

    private $courses;

    public function __construct()
    {

    }
}