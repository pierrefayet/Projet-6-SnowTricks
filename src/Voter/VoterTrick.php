<?php

declare(strict_types=1);

namespace App\Voter;

use App\Entity\Trick;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @phpstan-extends Voter<'edit'|'delete', Trick>
 */
class VoterTrick extends Voter
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        if ('edit' === $attribute && $subject instanceof Trick) {
            return true;
        }

        if ('delete' === $attribute && $subject instanceof Trick) {
            return true;
        }

        return false;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        if (! $subject instanceof Trick) {
            return false;
        }

        $user = $token->getUser();
        if (! $user instanceof User) {
            return false;
        }

        return $subject->getAuthor() === $user;
    }
}
