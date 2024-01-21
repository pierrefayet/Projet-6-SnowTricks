<?php

namespace App\Services;

use Symfony\Component\Security\Core\User\UserInterface;

class SecurityUser implements UserInterface
{
    /**
     * @return array
     */
    public function getRoles(): array
    {

        return ['ROLE_USER'];
    }
    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
        return '';
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}