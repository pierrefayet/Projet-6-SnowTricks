<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(nullable: true)]
    private ?int $id;

    #[ORM\Column(nullable: true)]
    private ?string $name;
    #[ORM\ManyToMany(targetEntity: Trick::class, inversedBy: 'tags')]
    private Collection $tricks;

    public function __construct()
    {
        $this->tricks = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTricks(): ArrayCollection
    {
        return $this->tricks;
    }

    public function addTrick(Trick $trick): void
    {
        if (! $this->tricks->contains($trick)) {
            $this->tricks[] = $trick;
        }
    }

    public function removeTrick(Trick $trick): void
    {
        $this->tricks->removeElement($trick);
    }
}
