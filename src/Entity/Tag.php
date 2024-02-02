<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @return int
     */
    public function getId(): int
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
     * @return string
     */
    public function getName(): string
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
     * @return ArrayCollection
     */
    public function getTricks(): ArrayCollection
    {
        return $this->tricks;
    }

    /**
     * @param Trick $trick
     */
    public function addTrick(Trick $trick): void
    {
        if (!$this->tricks->contains($trick)) {
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
