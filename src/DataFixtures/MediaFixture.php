<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class MediaFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($j = 1; $j <= 4; ++$j) {
            $image = new Image();
            $trick = $this->getReference('tricks' . $j);
            $image->setTrick($trick);
            $image->setFilename('50_50_Grinds.png');
            $image->setAlt($this->faker->sentence(2));
            $manager->persist($image);
        }

        for ($j = 1; $j <= 2; ++$j) {
            $video = new Video();
            $trick = $this->getReference('tricks' . $j);
            $video->setTrick($trick);
            $video->setFilename('50_50.mp4');
            $manager->persist($video);
        }

        $imageCustom = new Image();
        $trick       = $this->getReference('trickCustom');
        $imageCustom->setTrick($trick);
        $imageCustom->setFilename('50_50_Grinds.png');
        $imageCustom->setAlt($this->faker->sentence(2));
        $manager->persist($imageCustom);

        $videoCustom = new Video();
        $trick       = $this->getReference('trickCustom');
        $videoCustom->setTrick($trick);
        $videoCustom->setFilename('50_50.mp4');
        $manager->persist($videoCustom);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TrickFixtures::class,
        ];
    }
}
