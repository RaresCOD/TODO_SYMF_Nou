<?php

namespace App\Repository;

use App\Entity\TodoBun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TodoBun|null find($id, $lockMode = null, $lockVersion = null)
 * @method TodoBun|null findOneBy(array $criteria, array $orderBy = null)
 * @method TodoBun[]    findAll()
 * @method TodoBun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoBunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TodoBun::class);
    }

    // /**
    //  * @return TodoBun[] Returns an array of TodoBun objects
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
    public function findOneBySomeField($value): ?TodoBun
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
