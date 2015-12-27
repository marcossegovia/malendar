<?php

namespace Malendar\Domain\Model\Master;

use DateTime;
use Malendar\Domain\Model\Course\Course;
use Malendar\Domain\Model\User\User;
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
	 * @var User[]
	 */
	private $users;

	/**
	 * @var Course[]
	 */
	private $courses;

	public function __construct(
		$id,
		$name,
		$acronym,
		$description,
		$created_at,
		array $some_users,
		array $some_courses
	)
	{
		$this->id          = $id;
		$this->name        = $name;
		$this->acronym     = $acronym;
		$this->description = $description;
		$this->created_at  = $created_at;
	}

	public static function create(
		$a_name,
		$an_acronym,
		$a_description
	)
	{
		$a_new_id        = UuId::generate();
		$a_creation_date = new DateTime();
		$all_new_users   = [];
		$all_new_courses = [];

		return new self( $a_new_id, $a_name, $an_acronym, $a_description, $a_creation_date, $all_new_users,
						 $all_new_courses
		);
	}

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function acronym()
	{
		return $this->acronym;
	}

	/**
	 * @return string
	 */
	public function description()
	{
		return $this->description;
	}

	public function createdAt()
	{
		return $this->created_at;
	}

	/**
	 * @return array
	 */
	public function users()
	{
		return $this->users;
	}

	/**
	 * @return array
	 */
	public function courses()
	{
		return $this->courses;
	}

	public function addNewCourse()
	{

	}

}