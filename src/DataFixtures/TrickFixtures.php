<?php

namespace App\DataFixtures;

use App\Entity\Category;
use DateTimeImmutable;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $groups = [];
        for ($i = 1; $i <= 4; $i++) {
            $group = new Category();
            $group->setName($this->faker->word);
            $manager->persist($group);
            $groups[] = $group;
        }

        for ($i = 1; $i <= 50; $i++) {
            $trick = new Trick();
            $trick->setAuthor($this->getReference('users' . $i));
            $trick->setTitle($this->faker->sentence(2));
            $trick->setSlug((new AsciiSlugger())->slug(strtolower($trick->getTitle())));
            $trick->setIntro($this->faker->sentence(3));
            $trick->setContent($this->faker->paragraph);
            $trick->setCategory($groups[$i % count($groups)]);

            $manager->persist($trick);
            $this->addReference('tricks' .$i , $trick);
        }

        $trickCustom = new Trick();
        $trick->setAuthor($this->getReference('users' . $i));
        $trick->setTitle('toto');
        $trick->setSlug((new AsciiSlugger())->slug(strtolower($trick->getTitle())));
        $trick->setIntro($this->faker->sentence(3));
        $trick->setContent($this->faker->paragraph);
        $trick->setCategory($groups[$i % count($groups)]);

        $manager->persist($trickCustom);
        $manager->flush();
        $this->addReference('trickCustom', $trickCustom);

    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
