<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;

#[Entity]
#[InheritanceType('JOINED')]
#[DiscriminatorColumn(name: 'discr', type: 'string')]
#[DiscriminatorMap(['image' => Image::class, 'video' => Video::class])]
class UploadMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(nullable: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $filename = null;

    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: "medias")]
    #[ORM\JoinColumn(name: "trick_id", referencedColumnName: "id")]
    protected ?Trick $trick = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return Trick|null
     */
    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    /**
     * @param Trick|null $trick
     * @return $this
     */
    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }
}
