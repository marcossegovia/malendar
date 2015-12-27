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

	public function add(User $a_user)
	{
		foreach ($a_user->masters() as $master)
		{
			$this->_em->persist( $master );
		}
		$this->_em->persist( $a_user );
		$this->_em->flush();
	}

	/** @return User */
	public function findById(UuId $a_user_id)
	{
		$query = parent::find($a_user_id);
		return  $query->getSingleResult();
	}

	public function findByEmail(Email $an_email)
	{
		$query = $this->_em->createQuery( 'SELECT u FROM Malendar\Domain\Model\User\User u WHERE u.email.email = :email'
		);
		$query->setParameter( 'email', $an_email->getEmail() );

		return $query->getSingleResult();
	}

	public function findByUsername($a_username)
	{
		$query = $this->_em->createQuery( 'SELECT u FROM Malendar\Domain\Model\User\User u WHERE u.name = :name' );
		$query->setParameter( 'name', $a_username );

		return $query->getSingleResult();
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
}