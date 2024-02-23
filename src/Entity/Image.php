<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping as ORM;

#[Entity]
class Image extends UploadMedia
{
    #[ORM\Column(nullable: true)]
    protected ?string $alt = null;
    public function getType(): string
    {
        return 'image';
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): void
    {
        $this->alt = $alt;
    }

    public function getImageId(): Image
    {
        return $this->imageId;
    }

    public function setImageId(Image $imageId): void
    {
        $this->imageId = $imageId;
    }
}
