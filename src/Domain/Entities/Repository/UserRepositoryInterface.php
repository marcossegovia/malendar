<?php

namespace Malendar\Domain\Entities\Repository;

use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Domain\Entities\User\User;

interface UserRepositoryInterface
{
    public function nextIdentity();
    public function add(User $user);
    public function findAll();
    public function findByEmail(Email $mail);
    public function findByUsername($name);
    public function update();
    public function remove(User $user);
}