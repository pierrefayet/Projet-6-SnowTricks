<?php

namespace App\Services;

use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;

class HandleMedia
{
    public function handleMediaUpload($file, Trick $trick): void
    {
        $mimeType = $file->getMimeType();
        if (str_starts_with($mimeType, 'image/')) {
            $media = new Image();
            $directory = '/image/';
        } elseif (str_starts_with($mimeType, 'video/')) {
            $media = new Video();
            $directory = '/video/';
        } else {
            $this->addFlash('error', 'The format is supported are mp4 for video and png for image');
            return;
        }

        $newFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . uniqid() . '.' . $file->guessExtension();
        $file->move($this->getParameter('media_directory') . $directory, $newFilename);
        $media->setFilename($newFilename);
        $media->setTrick($trick);
    }

}