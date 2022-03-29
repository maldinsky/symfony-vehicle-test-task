<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\VehicleModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VehicleModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleModel[]    findAll()
 * @method VehicleModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleModel::class);
    }

    public function add(VehicleModel $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(VehicleModel $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
