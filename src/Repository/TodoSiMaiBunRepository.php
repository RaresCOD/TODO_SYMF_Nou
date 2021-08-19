<?php

namespace App\Repository;

use App\Entity\TodoSiMaiBun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TodoSiMaiBun|null find($id, $lockMode = null, $lockVersion = null)
 * @method TodoSiMaiBun|null findOneBy(array $criteria, array $orderBy = null)
 * @method TodoSiMaiBun[]    findAll()
 * @method TodoSiMaiBun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoSiMaiBunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TodoSiMaiBun::class);
    }

    // /**
    //  * @return TodoSiMaiBun[] Returns an array of TodoSiMaiBun objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TodoSiMaiBun
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
