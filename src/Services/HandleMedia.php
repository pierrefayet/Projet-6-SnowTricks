<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HandleMedia
{
    public function __construct(
        private readonly string $mediaDirectory,
        private readonly EntityManagerInterface $entitymanager)
    {
    }

    /**
     * Handles the upload of media files.
     *
     * @param UploadedFile[] $files array of UploadedFile instances
     * @param Trick $trick the trick to which the media belongs
     *
     * @throws \Exception
     */
    public function handleMediaUpload(array $files, Trick $trick): void
    {
        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $mimeType = $file->getMimeType();
            if (null === $mimeType) {
                throw new \Exception('File mime type could not be determined.');
            }
            $media = match (true) {
                str_starts_with($mimeType, 'image/') => new Image(),
                str_starts_with($mimeType, 'video/') => new Video(),
                default                              => throw new \Exception('Unsupported file type.'),
            };

            $directory       = $media instanceof Image ? 'image/' : 'video/';
            $newFilename     = pathinfo($file->getClientOriginalName(), \PATHINFO_FILENAME) . uniqid() . '.' . $file->guessExtension();
            $targetDirectory = $this->mediaDirectory . '/' . $directory;
            $file->move($targetDirectory, $newFilename);
            $media->setFilename($newFilename);
            $media->setTrick($trick);
            $this->entitymanager->persist($media);
        }

        $this->entitymanager->flush();
    }
}
