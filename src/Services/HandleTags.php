<?php

namespace App\Services;

use App\Entity\Tag;
use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;

class HandleTags
{
    public function handleTags(array $newTagsString, Trick $trick, EntityManagerInterface $entityManager): void
    {
            foreach ($newTagsString as $tagName) {
                $tagName = trim($tagName);
                if (!empty($tagName)) {
                    $tag = $entityManager->getRepository(Tag::class)->findOneBy(['name' => $tagName]);
                    if (!$tag) {
                        $tag = new Tag();
                        $tag->setName($tagName);
                        $entityManager->persist($tag);
                    }
                    $trick->addTag($tag);
                }
            }
    }
}
