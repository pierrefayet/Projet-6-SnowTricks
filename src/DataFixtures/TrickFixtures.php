<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class TrickFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $groups = [];
        for ($i = 1; $i <= 4; ++$i) {
            $group = new Category();
            $group->setName($this->faker->word);
            $manager->persist($group);
            $groups[] = $group;
        }

        for ($i = 1; $i <= 20; ++$i) {
            $trick           = new Trick();
            $authorReference = $this->getReference('users' . $i);

            if ($authorReference instanceof User) {
                $trick->setAuthor($authorReference);
            }

            $trick->setTitle($this->faker->sentence(2));
            $title = $trick->getTitle();

            if (\is_string($title)) {
                $trick->setSlug((new AsciiSlugger())->slug(strtolower($title))->toString());
            }

            $trick->setIntro($this->faker->sentence(3));
            $trick->setContent($this->faker->paragraph);
            $trick->setCategory($groups[$i % \count($groups)]);

            $manager->persist($trick);
            $this->addReference('tricks' . $i, $trick);
        }

        $trickCustom           = new Trick();
        $authorCustomReference = $this->getReference('userCustom');

        if ($authorCustomReference instanceof User) {
            $trickCustom->setAuthor($authorCustomReference);
        }

        $trickCustom->setTitle('test');
        $trickCustom->setSlug((new AsciiSlugger())->slug(strtolower('test'))->toString());
        $trickCustom->setIntro($this->faker->sentence(3));
        $trickCustom->setContent($this->faker->paragraph);
        $trickCustom->setCategory($groups[0]);

        $manager->persist($trickCustom);
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
