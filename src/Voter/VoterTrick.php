<?php

declare(strict_types=1);

namespace App\Voter;

use App\Entity\Trick;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

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
        return $subject->getAuthor() === $token->getUser();
    }
}
