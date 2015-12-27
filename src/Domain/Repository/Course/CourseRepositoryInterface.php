<?php

namespace Malendar\Domain\Repository\Course;

use Malendar\Domain\Model\Course\Course;
use Malendar\Domain\Model\ValueObject\UuId;

interface CourseRepositoryInterface
{
	public function add(Course $a_course);

	public function findAll();

	public function findByMasterId(UuId $a_master_id);

	public function update();

	public function remove(Course $a_course);
}