<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
class TrickSubscriber
{
    public function __construct(private readonly Security $security)
    {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (! $entity instanceof Trick || null === $this->security->getUser()) {
            return;
        }
        $entity->setAuthor($this->security->getUser());
        $entity->setSlug((new AsciiSlugger())->slug(strtolower($entity->getTitle())));
    }
}
