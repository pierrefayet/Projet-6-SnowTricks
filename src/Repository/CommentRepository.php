<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[] findAll()
 * @method Comment[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private readonly PaginatorInterface $paginator)
    {
        parent::__construct($registry, Comment::class);
    }

    public function paginateTrick(int $page, int $limit): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('c'),
            $page,
            $limit,
        );
    }
}
