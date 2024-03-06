<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Entity;

#[Entity]
class Video extends UploadMedia
{
    public function getType(): string
    {
        return 'video';
    }
}
