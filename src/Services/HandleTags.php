<?php

namespace App\Services;

use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;

class HandleTags
{
    public function handleTags(array $newTagsString, Trick $trick, EntityManagerInterface $entityManager): void
    {
            foreach ($newTagsString as $tagName) {
                $tagName = trim($tagName);
                if (!empty($tagName)) {
                    $tag = $entityManager->getRepository(Category::class)->findOneBy(['name' => $tagName]);
                    if (!$tag) {
                        $tag = new Category();
                        $tag->setName($tagName);
                        $entityManager->persist($tag);
                    }
                    $trick->addTag($tag);
                }
            }
    }
}
