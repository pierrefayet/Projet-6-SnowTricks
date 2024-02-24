<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

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
}
