<?php

namespace Malendar\Domain\Repository\User;

use Malendar\Domain\Model\User\User;
use Malendar\Domain\Model\ValueObject\Email;

interface UserRepositoryInterface
{
	public function add(User $a_user);

	/** @return User[] */
	public function findAll();

	/** @return User */
	public function findByEmail(Email $an_email);

	/** @return User */
	public function findByUsername($a_username);

	public function update();

	public function remove(User $a_user);
}