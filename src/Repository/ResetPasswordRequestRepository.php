<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ResetPasswordRequest;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Persistence\Repository\ResetPasswordRequestRepositoryTrait;
use SymfonyCasts\Bundle\ResetPassword\Persistence\ResetPasswordRequestRepositoryInterface;

/**
 * @extends ServiceEntityRepository<ResetPasswordRequest>
 *
 * @method ResetPasswordRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResetPasswordRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResetPasswordRequest[] findAll()
 * @method ResetPasswordRequest[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResetPasswordRequestRepository extends ServiceEntityRepository implements ResetPasswordRequestRepositoryInterface
{
    use ResetPasswordRequestRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResetPasswordRequest::class);
    }

    /**
     * @throws \Exception
     */
    public function createResetPasswordRequest(object $user, \DateTimeInterface $expiresAt, string $selector, string $hashedToken): ResetPasswordRequestInterface
    {
        if (! $user instanceof User) {
            return throw new \Exception(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        return new ResetPasswordRequest($user, $expiresAt, $selector, $hashedToken);
    }
}
