<?php


namespace Malendar\Domain\Entities\Master;


class Master
{
    /**
     * @var integer
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
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $users;

    /**
     * @var array
     */
    private $courses;



    public function __construct($id, $name, $acronym, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->acronym = $acronym;
        $this->description = $description;
    }
}