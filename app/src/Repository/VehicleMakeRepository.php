<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\VehicleMake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Collection;

/**
 * @method VehicleMake|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleMake|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleMake[]    findAll()
 * @method VehicleMake[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleMakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleMake::class);
    }

    public function add(VehicleMake $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(VehicleMake $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findOneByTypeAndMake(?string $vehicleType = null, ?string $vehicleMake = null): ?VehicleMake
    {
        return $this->findOneBy([
            'code' => $vehicleMake,
            'vehicleType' => $vehicleType,
        ]);
    }
}
