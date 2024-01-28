<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $trick = new Trick();
        $trick->setTitle('Lorem');
        $trick->setContent('Lorem Ipsilum');
        $trick->setImage('/assets/tricks/50 50 Grinds.png');
        $manager->persist($trick);
        $manager->flush();
    }
}
