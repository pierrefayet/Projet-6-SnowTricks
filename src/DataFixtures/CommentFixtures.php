<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; ++$i) {
            $comment = new Comment();
            $comment->setTrick($this->getReference('tricks' . $i));
            $comment->setCommentUserId($this->getReference('users' . $i));
            $comment->setContent($this->faker->sentence(10));
            $manager->persist($comment);
        }

        $commentCustom = new Comment();
        $commentCustom->setTrick($this->getReference('trickCustom'));
        $commentCustom->setCommentUserId($this->getReference('userCustom'));
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
