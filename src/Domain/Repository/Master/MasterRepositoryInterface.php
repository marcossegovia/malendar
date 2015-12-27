<?php

namespace Malendar\Domain\Repository\Master;

use Malendar\Domain\Model\Master\Master;
use Malendar\Domain\Model\ValueObject\UuId;

interface MasterRepositoryInterface
{
	public function add(Master $a_master);

	public function findAll();

	public function findByUserId(UuId $a_user_id);

	public function update();

	public function remove(Master $a_master);
}