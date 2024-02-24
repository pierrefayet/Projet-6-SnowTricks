<?php

namespace App\Services;

class GivePathMedia
{
    public function __construct(private readonly string $mediaDirectory,)
    {
    }

    public function getPathMedia(): string
    {
        return $this->mediaDirectory;
    }
}