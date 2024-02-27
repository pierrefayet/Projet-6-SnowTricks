<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UploadMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UploadMedia>
 *
 * @method UploadMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method UploadMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method UploadMedia[] findAll()
 * @method UploadMedia[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UploadMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UploadMedia::class);
    }
}
