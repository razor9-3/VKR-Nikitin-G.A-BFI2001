<?php

namespace App\Repository;

use App\Entity\ContractItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContractItem>
 *
 * @method ContractItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractItem[]    findAll()
 * @method ContractItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractItem::class);
    }

//    /**
//     * @return ContractItem[] Returns an array of ContractItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContractItem
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
