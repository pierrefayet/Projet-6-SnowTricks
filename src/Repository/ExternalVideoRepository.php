<?php

namespace App\Repository;

use App\Entity\ExternalMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExternalMedia>
 *
 * @method ExternalMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExternalMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExternalMedia[]    findAll()
 * @method ExternalMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExternalVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExternalMedia::class);
    }

//    /**
//     * @return ExternalMedia[] Returns an array of ExternalMedia objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExternalMedia
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
