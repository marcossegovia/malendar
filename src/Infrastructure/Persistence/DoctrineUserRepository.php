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

	public function add(User $a_user)
	{
		foreach ($a_user->masters() as $master)
		{
			$this->_em->persist( $master );
		}
		$this->_em->persist( $a_user );
		$this->_em->flush();
	}

	public function findByEmail(Email $an_email)
	{
		$query = $this->_em->createQuery( 'SELECT u FROM Malendar\Domain\Model\User\User u WHERE u.email.email = :email'
		);
		$query->setParameter( 'email', $an_email->getEmail() );
		$user = $query->getResult();

		return $user == NULL ? self::NO_USER_FOUND : new User( $user[0]->id(), $user[0]->name(),
															   $user[0]->email(), $user[0]->hashCode(),
															   $user[0]->isAdmin(), $user[0]->masters()
		);
	}

	public function findByUsername($a_username)
	{
		$query = $this->_em->createQuery( 'SELECT u FROM Malendar\Domain\Model\User\User u WHERE u.name = :name' );
		$query->setParameter( 'name', $a_username );
		$user = $query->getResult();

		return $user == NULL ? self::NO_USER_FOUND : new User( $user[0]->id(), $user[0]->name(),
															   $user[0]->email(), $user[0]->hashCode(),
															   $user[0]->isAdmin(), $user[0]->masters()
		);
	}

	public function update()
	{
		$this->_em->flush();
	}

	public function remove(User $a_user)
	{
		$this->_em->remove( $a_user );
		$this->_em->flush();
	}

	public function removeMaster(Master $a_master)
	{
		$this->_em->remove( $a_master );
		$this->_em->flush();
	}

}