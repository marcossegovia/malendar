<?php


namespace Malendar\Domain\Entities\Master;

use Doctrine\Common\Collections\ArrayCollection;
use Malendar\Domain\Entities\ValueObject\UuId;

class Master
{
    /**
     * @var UuId
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
        $this->users = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }

}