<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ExternalVideoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExternalVideoRepository::class)]
class ExternalVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $url = null;
    #[ORM\Column]
    private ?int $platformId = null;

    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'externalVideo')]
    #[ORM\JoinColumn(name: 'trick_id', referencedColumnName: 'id')]
    protected ?Trick $trick = null;

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): void
    {
        $this->trick = $trick;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatformId(): ?int
    {
        return $this->platformId;
    }

    public function setPlatformId(?int $platformId): void
    {
        $this->platformId = $platformId;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}
