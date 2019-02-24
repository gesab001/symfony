<?php

namespace App\Repository;

use App\Entity\Bible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bible|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bible|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bible[]    findAll()
 * @method Bible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BibleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bible::class);
    }

    // /**
    //  * @return Bible[] Returns an array of Bible objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bible
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
