<?php

namespace Malendar\Domain\Model\Master;

use DateTime;
use Malendar\Domain\Model\ValueObject\UuId;

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
	 * @var Datetime;
	 */
	private $created_at;

	/**
	 * @var array
	 */
	private $users;

	/**
	 * @var array
	 */
	private $courses;

	public function __construct($id, $name, $acronym, $description, $created_at)
	{
		$this->id          = $id;
		$this->name        = $name;
		$this->acronym     = $acronym;
		$this->description = $description;
		$this->created_at  = $created_at;
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

	public function getCreatedAt()
	{
		return $this->created_at;
	}

	/**
	 * @return array
	 */
	public function getUsers()
	{
		return $this->users;
	}

	public function addNewCourse()
	{

	}

}