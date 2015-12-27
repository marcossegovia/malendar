<?php

namespace Malendar\Domain\Service\User;

use Malendar\Domain\Model\User\User;
use Malendar\Domain\Model\ValueObject\UuId;
use Malendar\Domain\Repository\Course\CourseRepositoryInterface;
use Malendar\Domain\Repository\Master\MasterRepositoryInterface;
use Malendar\Domain\Repository\User\UserRepositoryInterface;
use Malendar\Domain\Service\UserReaderInterface;

class UserReader implements UserReaderInterface
{
	const NO_USER_FOUND = FALSE;

	private $user_repository;
	private $master_repository;
	private $course_repository;

	public function __construct(
		UserRepositoryInterface $a_user_repository,
		MasterRepositoryInterface $a_master_repository,
		CourseRepositoryInterface $a_course_repository
	)
	{
		$this->user_repository   = $a_user_repository;
		$this->master_repository = $a_master_repository;
		$this->course_repository = $a_course_repository;
	}

	public function __invoke(Uuid $an_uuid)
	{

		//return new User();
	}
}