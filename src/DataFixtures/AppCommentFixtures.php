<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppCommentFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $comment = new Comment();
            $comment->setTrick( $this->getReference('trick'));
            $comment->setCommentUserId($this->getReference('user' . $i));
            $comment->setContent($this->faker->paragraph);
            $manager->persist($comment);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            AppUserFixtures::class,
            AppTrickFixtures::class
        ];
    }
}