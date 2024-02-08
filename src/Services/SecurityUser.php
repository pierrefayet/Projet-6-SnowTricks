<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Component\Security\Core\User\UserInterface;

class SecurityUser implements UserInterface
{
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
        return '';
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }
}
