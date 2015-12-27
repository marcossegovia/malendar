<?php

namespace Malendar\Infrastructure\Persistence;

use Doctrine\ORM\EntityRepository;
use Malendar\Domain\Model\Master\Master;
use Malendar\Domain\Model\ValueObject\UuId;
use Malendar\Domain\Repository\Master\MasterRepositoryInterface;

class DoctrineMasterRepository extends EntityRepository implements MasterRepositoryInterface
{
	public function add(Master $master)
	{
		$this->_em->persist( $master );
		$this->_em->flush();
	}

	public function findByUserId(UuId $uuId)
	{

	}

	public function update()
	{
		$this->_em->flush();
	}

	public function remove(Master $master)
	{
		$this->_em->remove( $master );
		$this->_em->flush();
	}
}