<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Tag;
use App\Entity\Video;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppTrickFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 4; $i++) {
            $tag = new Tag();
            $tag->setName($this->faker->word);
            $manager->persist($tag);
            $tags[] = $tag;
        }

        for ($i = 1; $i <= 10; $i++) {
            $trick = new Trick();
            $trick->setAuthor($this->getReference('UserFixtures' . $i));
            $trick->setTitle($this->faker->sentence(2));
            $trick->setIntro($this->faker->sentence(3));
            $trick->setContent($this->faker->paragraph);
            $trick->setCreationDate($this->faker->dateTime());

            foreach ($tags as $tag) {
                $trick->addTag($tag);
            }


            $manager->persist($trick);
        }
        $manager->flush();
        $this->addReference('trick', $trick);
    }

    public function getDependencies(): array
    {
        return [
            AddedUserFixtures::class
        ];
    }
}
