<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
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
        for ($i = 1; $i <= 4; ++$i) {
            $group = new Category();
            $group->setName($this->faker->word);
            $manager->persist($group);
            $groups[] = $group;
        }

        for ($i = 1; $i <= 50; ++$i) {
            $trick = new Trick();
            $trick->setAuthor($this->getReference('users' . $i));
            $trick->setTitle($this->faker->sentence(2));
            $trick->setSlug((new AsciiSlugger())->slug(strtolower($trick->getTitle()))->toString());
            $trick->setIntro($this->faker->sentence(3));
            $trick->setContent($this->faker->paragraph);
            $trick->setCategory($groups[$i % \count($groups)]);

            $manager->persist($trick);
            $this->addReference('tricks' . $i, $trick);
        }

        $trickCustom = new Trick();
        $trickCustom->setAuthor($this->getReference('userCustom'));
        $trickCustom->setTitle('test');
        $trickCustom->setSlug((new AsciiSlugger())->slug(strtolower($trick->getTitle()))->toString());
        $trickCustom->setIntro($this->faker->sentence(3));
        $trickCustom->setContent($this->faker->paragraph);
        $trickCustom->setCategory($groups[$i % \count($groups)]);

        $manager->persist($trick);
        $this->addReference('trickCustom', $trickCustom);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
