<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['userName'], message: 'There is already an account with this name')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(nullable: true)]
    private ?string $userName;

    #[ORM\Column(nullable: true)]
    private ?string $email;

    #[ORM\Column(nullable: true)]
    private ?string $password;
    #[ORM\Column(nullable: true)]
    private ?array $roles = ['ROLE_USER'];

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;
    #[ORM\Column(nullable: true)]
    private ?string $userImage = null;

    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserImage(): ?string
    {
        return $this->userImage;
    }

    public function setUserImage(?string $userImage): void
    {
        $this->userImage = $userImage;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return ?string
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function getUserIdentifier(): string
    {
        return $this->userName;
    }

    /**
     * @param ?string $userName
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param ?string $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function eraseCredentials(): void
    {
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * @return User
     */
    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
