<?php

namespace App\Repository;

use App\Document\TodoSiMaiBun;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;

/**
 * @method TodoSiMaiBun|null find($id, $lockMode = null, $lockVersion = null)
 * @method TodoSiMaiBun|null findOneBy(array $criteria, array $orderBy = null)
 * @method TodoSiMaiBun[]    findAll()
 * @method TodoSiMaiBun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoSiMaiBunRepository extends DocumentRepository
{

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
