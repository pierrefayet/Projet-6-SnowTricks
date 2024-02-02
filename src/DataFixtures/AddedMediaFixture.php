<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Media;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AddedMediaFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $media = new Media();
        for ($j = 1; $j <= 4; $j++) {
            $image = new Image();
            $trick = $this->getReference('trick');
            $image->setTrick($trick);
            $image->setFilename('50_50_Grinds.png');
            $image->setAlt($this->faker->sentence(2));
            $manager->persist($image);
        }

        for ($j = 1; $j <= 2; $j++) {
            $video = new Video();
            $trick = $this->getReference('trick');
            $video->setTrick($trick);
            $video->setFilename('50_50_Grinds_easy_snowboard.576d4151.mp4');
            $manager->persist($video);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            AppTrickFixtures::class,
        ];
    }
}