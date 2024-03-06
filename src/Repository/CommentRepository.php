<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Trick;
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

    /**
     * Paginates the comments for a given trick.
     *
     * @param int $page The current page number
     * @param int $limit The number of items per page
     * @param Trick $trick The trick entity
     *
     * @return PaginationInterface<int, Comment> The paginated comments
     */
    public function paginateTrick(int $page, int $limit, Trick $trick): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('c')
            ->WHERE('c.trick  = :trick')
            ->setParameter('trick', $trick),
            $page,
            $limit,
        );
    }
}
