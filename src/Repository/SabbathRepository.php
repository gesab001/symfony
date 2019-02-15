<?php

namespace App\Repository;

use App\Entity\Sabbath;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sabbath|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sabbath|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sabbath[]    findAll()
 * @method Sabbath[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SabbathRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sabbath::class);
    }

    // /**
    //  * @return Sabbath[] Returns an array of Sabbath objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sabbath
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
