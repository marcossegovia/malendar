<?php

namespace Malendar\Application\Service\User;

use Malendar\Domain\Model\ValueObject\UuId;

final class ShowMastersInfoFromUserRequest
{
	private $user_id;

	public function __construct(Uuid $a_user_id)
	{
		$this->user_id = $a_user_id;
	}

	public function userId()
	{
		return $this->user_id;
	}
}