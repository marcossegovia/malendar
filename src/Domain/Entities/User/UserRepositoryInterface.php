<?php

namespace Malendar\Domain\Entities\User;

use Malendar\Domain\Entities\ValueObject\Email;

interface UserRepositoryInterface
{
	public function add(User $user);

	public function findAll();

	public function findByEmail(Email $mail);

	public function findByUsername($name);

	public function update();

	public function remove(User $user);
}