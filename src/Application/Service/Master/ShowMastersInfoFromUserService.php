<?php

namespace Malendar\Application\Service\Master;

use Malendar\Domain\Service\UserReaderInterface;

final class ShowMastersInfoFromUserService
{
	private $user_info_reader;

	public function _construct(UserReaderInterface $user_reader_domain_service)
	{
		$this->user_info_reader = $user_reader_domain_service;
	}

	public function __invoke(ShowMastersInfoFromUserRequest $a_show_master_info_request)
	{
		$this->user_info_reader->__invoke($a_show_master_info_request->userId());
	}
}