<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SearchLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SearchLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method SearchLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method SearchLog[]    findAll()
 * @method SearchLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SearchLog::class);
    }

    public function add(SearchLog $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(SearchLog $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
