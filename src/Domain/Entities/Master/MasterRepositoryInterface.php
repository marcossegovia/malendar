<?php


namespace Malendar\Domain\Entities\Master;

use Malendar\Domain\Entities\ValueObject\UuId;

interface MasterRepositoryInterface
{
    public function add(Master $master);
    public function findAll();
    public function findByUserId(UuId $userId);
    public function update();
    public function remove(Master $master);
}