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

	public function findByUserId(UuId $a_user_id)
	{
		$queryBuilder = $this->_em->createQueryBuilder( 'u' );
		$queryBuilder->select( 'm' )
			->from( 'Malendar\Domain\Model\Master\Master', 'm' )
			->leftjoin( 'Malendar\Domain\Model\User\User', 'u' )
			->where( 'u.id.id = :userId' )
			->orderBy( 'm.created_at', 'DESC' )
			->setParameter( 'userId', $a_user_id->id() );
		return $queryBuilder->getQuery()->getResult();
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