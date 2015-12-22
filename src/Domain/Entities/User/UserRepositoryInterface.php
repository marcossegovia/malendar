<?php

namespace Malendar\Domain\Entities\User;

use Malendar\Domain\Entities\ValueObject\Email;

interface UserRepositoryInterface
{
	public function add(User $user);

	/** @return User[] */
	public function findAll();

	/** @return User */
	public function findByEmail(Email $mail);

	/** @return User */
	public function findByUsername($name);

	public function update();

	public function remove(User $user);
}