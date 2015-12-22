<?php

namespace Malendar\Infrastructure\Persistence;

use Doctrine\ORM\EntityRepository;
use Malendar\Domain\Entities\Master\Master;
use Malendar\Domain\Entities\User\UserRepositoryInterface;
use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Domain\Entities\User\User;
use Malendar\Domain\Entities\ValueObject\UuId;
use Malendar\Infrastructure\Factory\MasterFactory;
use Malendar\Infrastructure\Factory\UserFactory;

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
		$query = $this->_em->createQuery( 'SELECT u FROM Malendar\Domain\Entities\User\User u WHERE u.email.email = :email'
		);
		$query->setParameter( 'email', $email->getEmail() );
		$user = $query->getResult();

		return $user == NULL ? self::NO_USER_FOUND : UserFactory::create( $user[0]->getId(), $user[0]->getName(),
																		  $user[0]->getEmail(), $user[0]->isAdmin(),
																		  NULL, $user[0]->getHashCode()
		);
	}

	public function findByUsername($username)
	{
		$query = $this->_em->createQuery( 'SELECT u FROM Malendar\Domain\Entities\User\User u WHERE u.name = :name' );
		$query->setParameter( 'name', $username );
		$user = $query->getResult();

		return $user == NULL ? self::NO_USER_FOUND : UserFactory::create( $user[0]->getId(), $user[0]->getName(),
																		  $user[0]->getEmail(), $user[0]->isAdmin(),
																		  NULL, $user[0]->getHashCode()
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

	public function findAllRelatedMasters(Uuid $userId)
	{
		$queryBuilder = $this->_em->createQueryBuilder( 'u' );
		$queryBuilder->select( 'm' )
			->from( 'Malendar\Domain\Entities\Master\Master', 'm' )
			->leftjoin( 'Malendar\Domain\Entities\User\User', 'u' )
			->where( 'u.id.id = :userId' )
			->orderBy( 'm.created_at', 'DESC' )
			->setParameter( 'userId', $userId->id() );
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