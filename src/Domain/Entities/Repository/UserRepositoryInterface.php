<?php

namespace Malendar\Domain\Entities\Repository;

interface UserRepositoryInterface
{
    public function nextIdentity();
    public function add();
    public function findAll();
    public function findByEmail();
    public function findByUsername();
    public function update();
    public function remove();
}