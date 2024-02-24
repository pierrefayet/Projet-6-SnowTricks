<?php

namespace App\Services;

readonly class ImageService
{
    public function __construct(private string $mediaDirectory)
    {
    }

    public function buildImage($file, $directory): string
    {
        $newFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . uniqid() . '.' . $file->guessExtension();
        $targetDirectory = $this->mediaDirectory . '/' . $directory;
        $file->move($targetDirectory, $newFilename);

        return $newFilename;
    }
}