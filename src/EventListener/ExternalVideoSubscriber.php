<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Entity\ExternalVideo;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsDoctrineListener(event: Events::preUpdate, priority: 500, connection: 'default')]
#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
class ExternalVideoSubscriber
{
    public function __construct(private readonly Security $security)
    {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $this->applyExternalVideoEmbeddedUrl($args->getObject());
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $this->applyExternalVideoEmbeddedUrl($args->getObject());
    }

    private function applyExternalVideoEmbeddedUrl(object $entity): void
    {
        if (! $entity instanceof ExternalVideo || null === $this->security->getUser()) {
            return;
        }

        if (1 === $entity->getPlatformId()) {
            $entity->setUrl($this->getYoutubeEmbedUrl($entity->getUrl()));
        }

        if (2 === $entity->getPlatformId()) {
            $entity->setUrl($this->getDailymotionEmbedUrl($entity->getUrl()));
        }
    }

    public function getYoutubeEmbedUrl(?string $url): string
    {
        if (null === $url) {
            return 'URL is null or not provided';
        }

        $youtube_id    = '';
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex  = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[\count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[\count($matches) - 1];
        }

        return 'https://www.youtube.com/embed/' . $youtube_id;
    }

    public function getDailymotionEmbedUrl(?string $url): string
    {
        if (null === $url) {
            return 'URL is null or not provided';
        }

        $shortUrlRegex = '/dai.ly\/([a-zA-Z0-9]+)/i';
        $longUrlRegex  = '/dailymotion.com\/video\/([a-zA-Z0-9]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $dailymotion_id = $matches[1];
        } elseif (preg_match($shortUrlRegex, $url, $matches)) {
            $dailymotion_id = $matches[1];
        } else {
            return 'URL not recognized';
        }

        return 'https://www.dailymotion.com/embed/video/' . $dailymotion_id;
    }
}
