<?php


namespace Malendar\Infrastructure\Persistence;


use Doctrine\ORM\EntityRepository;
use Malendar\Domain\Entities\Master\Master;
use Malendar\Domain\Entities\Master\MasterRepositoryInterface;
use Malendar\Domain\Entities\ValueObject\UuId;

class DoctrineMasterRepository extends EntityRepository implements MasterRepositoryInterface
{


    public function add(Master $master)
    {

    }

    public function findByUserId(UuId $uuId)
    {

    }

    public function update()
    {

    }

    public function remove(Master $master)
    {

    }
}