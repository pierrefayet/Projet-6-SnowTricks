<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[UniqueEntity('name')]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(nullable: true)]
    private ?int $id;

    #[ORM\Column(nullable: true)]
    private ?string $name;

    /**
     * @var Collection<int, Trick>
     */
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Trick::class)]
    private Collection $tricks;

    public function __construct()
    {
        $this->tricks = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection<int, Trick>
     */
    public function getTricks(): Collection
    {
        return $this->tricks;
    }

    /**
     * @param Trick $trick
     */
    public function addTrick(Trick $trick): void
    {
        if (! $this->tricks->contains($trick)) {
            $this->tricks[] = $trick;
        }
    }

    /**
     * @param Trick $trick
     */
    public function removeTrick(Trick $trick): void
    {
        $this->tricks->removeElement($trick);
    }
}
