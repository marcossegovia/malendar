<?php


namespace Malendar\Domain\Entities\Master;

use Malendar\Domain\Entities\ValueObject\UserId;

interface MasterRepositoryInterface
{
    public function add(Master $master);
    public function findAll();
    public function findByUserId(UserId $userId);
    public function update();
    public function remove(Master $master);
}