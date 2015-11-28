<?php


namespace Malendar\Infrastructure\Persistence;

use Doctrine\ORM\EntityRepository;
use Malendar\Domain\Entities\User\UserRepositoryInterface;
use Malendar\Domain\Entities\ValueObject\Email;
use Malendar\Domain\Entities\User\User;
use Malendar\Infrastructure\Factory\UserFactory;

class DoctrineUserRepository extends EntityRepository implements UserRepositoryInterface
{
    const NO_USER_FOUND = false;

    public function add(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findAll()
    {
        return $this->_em->findAll();
    }

    public function findByEmail(Email $email)
    {
        $query = $this->_em->createQuery('SELECT u FROM Malendar\Domain\Entities\User\User u WHERE u.email.email = :email');
        $query->setParameter('email', $email->getEmail());
        $user = $query->getResult();
        return $user == null ? self::NO_USER_FOUND : UserFactory::create($user[0]->getUserId(), $user[0]->getName(),
            $user[0]->getEmail(), $user[0]->admin(), null, $user[0]->getHashCode());
    }

    public function findByUsername($username)
    {
        $query = $this->_em->createQuery('SELECT u FROM Malendar\Domain\Entities\User\User u WHERE u.name = :namee');
        $query->setParameter('namee', $username);
        $user = $query->getResult();
        return $user == null ? self::NO_USER_FOUND : UserFactory::create($user[0]->getUserId(), $user[0]->getName(),
            $user[0]->getEmail(), $user[0]->admin(), null, $user[0]->getHashCode());
    }

    public function update()
    {
        $this->_em->flush();
    }

    public function remove(User $user)
    {
        $this->_em->remove($user);
        $this->_em->flush();
    }

}