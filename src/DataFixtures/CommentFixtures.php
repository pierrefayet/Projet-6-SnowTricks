<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; ++$i) {
            $comment        = new Comment();
            $trickReference = $this->getReference('tricks' . $i);

            if ($trickReference instanceof Trick) {
                $comment->setTrick($trickReference);
            }

            $userReference = $this->getReference('users' . $i);

            if ($userReference instanceof User) {
                $comment->setCommentUserId($userReference);
            }

            $comment->setContent($this->faker->sentence(10));
            $manager->persist($comment);
        }

        $commentCustom        = new Comment();
        $trickSingleReference = $this->getReference('trickCustom');

        if ($trickSingleReference instanceof Trick) {
            $comment->setTrick($trickSingleReference);
        }

        $userSingleReference = $this->getReference('userCustom');

        if ($userSingleReference instanceof User) {
            $comment->setCommentUserId($userSingleReference);
        }

        $commentCustom->setContent($this->faker->sentence(10));
        $manager->persist($commentCustom);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            TrickFixtures::class,
        ];
    }
}
