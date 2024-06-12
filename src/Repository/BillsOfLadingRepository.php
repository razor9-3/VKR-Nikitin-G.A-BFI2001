<?php

namespace App\Repository;

use App\Entity\BillsOfLading;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BillsOfLading>
 *
 * @method BillsOfLading|null find($id, $lockMode = null, $lockVersion = null)
 * @method BillsOfLading|null findOneBy(array $criteria, array $orderBy = null)
 * @method BillsOfLading[]    findAll()
 * @method BillsOfLading[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BillsOfLadingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BillsOfLading::class);
    }

//    /**
//     * @return BillsOfLading[] Returns an array of BillsOfLading objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BillsOfLading
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
