<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Trick;
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
            $image          = new Image();
            $trickReference = $this->getReference('tricks' . $j);

            if ($trickReference instanceof Trick) {
                $image->setTrick($trickReference);
                $image->setFilename('50_50_Grinds.png');
                $image->setAlt($this->faker->sentence(2));
                $manager->persist($image);
            }
        }

        for ($j = 1; $j <= 2; ++$j) {
            $video          = new Video();
            $trickReference = $this->getReference('tricks' . $j);

            if ($trickReference instanceof Trick) {
                $video->setTrick($trickReference);
                $video->setFilename('50_50.mp4');
                $manager->persist($video);
            }
        }

        $imageCustom          = new Image();
        $trickSingleReference = $this->getReference('trickCustom');

        if ($trickSingleReference instanceof Trick) {
            $imageCustom->setTrick($trickSingleReference);
            $imageCustom->setFilename('50_50_Grinds.png');
            $imageCustom->setAlt($this->faker->sentence(2));
            $manager->persist($imageCustom);
        }

        $videoCustom          = new Video();
        $trickSingleReference = $this->getReference('trickCustom');

        if ($trickSingleReference instanceof Trick) {
            $videoCustom->setTrick($trickSingleReference);
            $videoCustom->setFilename('50_50.mp4');
            $manager->persist($videoCustom);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TrickFixtures::class,
        ];
    }
}
