<?php

namespace Malendar\Infrastructure\Persistence;

use Doctrine\ORM\EntityRepository;
use Malendar\Domain\Model\Master\Master;
use Malendar\Domain\Model\ValueObject\Email;
use Malendar\Domain\Model\User\User;
use Malendar\Domain\Model\ValueObject\UuId;
use Malendar\Domain\Repository\User\UserRepositoryInterface;

class DoctrineUserRepository extends EntityRepository implements UserRepositoryInterface
{
	const NO_USER_FOUND = FALSE;

	public function add(User $user)
	{
		foreach ($user->getMasters() as $master)
		{
			$this->_em->persist( $master );
		}
		$this->_em->persist( $user );
		$this->_em->flush();
	}

	public function findByEmail(Email $email)
	{
		$query = $this->_em->createQuery( 'SELECT u FROM Malendar\Domain\Model\User\User u WHERE u.email.email = :email'
		);
		$query->setParameter( 'email', $email->getEmail() );
		$user = $query->getResult();

		return $user == NULL ? self::NO_USER_FOUND : UserFactory::create( $user[0]->id(), $user[0]->name(),
																		  $user[0]->email(), $user[0]->isAdmin(),
																		  NULL, $user[0]->hashCode()
		);
	}

	public function findByUsername($username)
	{
		$query = $this->_em->createQuery( 'SELECT u FROM Malendar\Domain\Model\User\User u WHERE u.name = :name' );
		$query->setParameter( 'name', $username );
		$user = $query->getResult();

		return $user == NULL ? self::NO_USER_FOUND : UserFactory::create( $user[0]->id(), $user[0]->name(),
																		  $user[0]->email(), $user[0]->isAdmin(),
																		  NULL, $user[0]->hashCode()
		);
	}

	public function update()
	{
		$this->_em->flush();
	}

	public function remove(User $user)
	{
		$this->_em->remove( $user );
		$this->_em->flush();
	}

	public function removeMaster(Master $master)
	{
		$this->_em->remove( $master );
		$this->_em->flush();
	}

	public function findAllRelatedMasters(Uuid $a_user_id)
	{
		$queryBuilder = $this->_em->createQueryBuilder( 'u' );
		$queryBuilder->select( 'm' )
			->from( 'Malendar\Domain\Model\Master\Master', 'm' )
			->leftjoin( 'Malendar\Domain\Model\User\User', 'u' )
			->where( 'u.id.id = :userId' )
			->orderBy( 'm.created_at', 'DESC' )
			->setParameter( 'userId', $a_user_id->id() );
		$arrayRawMasters = $queryBuilder->getQuery()->getResult();

		$arrayMasters = [];
		/** @var Master $master */
		foreach ($arrayRawMasters as $master)
		{
			$arrayMasters[] = MasterFactory::create( $master->getId(), $master->getName(), $master->getAcronym(),
													 $master->getDescription(), $master->getCreatedAt()
			);
		}

		return $arrayMasters;
	}

}