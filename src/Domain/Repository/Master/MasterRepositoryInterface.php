<?php

namespace Malendar\Domain\Repository\Master;

use Malendar\Domain\Model\Master\Master;
use Malendar\Domain\Model\ValueObject\UuId;

interface MasterRepositoryInterface
{
	public function add(Master $master);

	public function findAll();

	public function findByUserId(UuId $an_user_id);

	public function update();

	public function remove(Master $master);
}