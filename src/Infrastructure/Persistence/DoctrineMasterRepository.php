<?php

namespace Malendar\Infrastructure\Persistence;

use Doctrine\ORM\EntityRepository;
use Malendar\Domain\Model\Master\Master;
use Malendar\Domain\Model\ValueObject\UuId;
use Malendar\Domain\Repository\Master\MasterRepositoryInterface;

class DoctrineMasterRepository extends EntityRepository implements MasterRepositoryInterface
{
	public function add(Master $a_master)
	{
		$this->_em->persist( $a_master );
		$this->_em->flush();
	}

	public function findByUserId(UuId $an_user_id)
	{

	}

	public function update()
	{
		$this->_em->flush();
	}

	public function remove(Master $a_master)
	{
		$this->_em->remove( $a_master );
		$this->_em->flush();
	}
}