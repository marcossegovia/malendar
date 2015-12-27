<?php

namespace Malendar\Domain\Service;

use Malendar\Domain\Model\ValueObject\UuId;

interface UserReaderInterface
{
	public function __invoke(Uuid $an_uuid);
}