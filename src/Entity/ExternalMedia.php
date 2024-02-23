<?php

namespace App\Entity;

use App\Repository\ExternalMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExternalMediaRepository::class)]
class ExternalMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $platform = null;
    #[ORM\Column]
    private ?int $platformId = null;

    public function getPlatformId(): ?int
    {
        return $this->platformId;
    }

    public function setPlatformId(?int $platformId): void
    {
        $this->platformId = $platformId;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(?string $platform): void
    {
        $this->platform = $platform;
    }
}
