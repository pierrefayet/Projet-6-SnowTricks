<?php

declare(strict_types=1);

namespace App\Voter;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @phpstan-extends Voter<'add' | 'edit' | 'delete', null>
 */
class VoterUser extends Voter
{
    public function __construct(readonly private RequestStack $requestStack)
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        if ('add' === $attribute || 'delete' === $attribute || 'edit' === $attribute) {
            return true;
        }

        $request = $this->requestStack->getCurrentRequest();

        if (! $request) {
            return false;
        }

        if ('add_comment' === $attribute && $request->isMethod('POST')) {
            return true;
        }

        return false;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (! $user instanceof User || false === $user->isVerified()) {
            return false;
        }

        return true;
    }
}
