<?php

declare(strict_types=1);

namespace App\Services;

class ImageService
{
    public function __construct(private readonly string $mediaDirectory)
    {
    }

    public function buildImage($file, string $directory): string
    {
        $newFilename     = pathinfo($file->getClientOriginalName(), \PATHINFO_FILENAME) . uniqid() . '.' . $file->guessExtension();
        $targetDirectory = $this->mediaDirectory . '/' . $directory;
        $file->move($targetDirectory, $newFilename);

        return $newFilename;
    }
}
