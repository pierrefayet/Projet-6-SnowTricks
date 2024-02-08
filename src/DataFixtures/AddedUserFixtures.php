<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AddedUserFixtures extends Fixture
{
    private Generator $faker;
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->faker           = Factory::create('fr_FR');
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; ++$i) {
            $user = new User();
            $user->setUserName($this->faker->word());
            $user->setEmail($this->faker->email());
            $user->setPassword($this->passwordEncoder->hashPassword($user, 'TEST'));
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
            $this->addReference('UserFixtures' . $i, $user);
        }
        $manager->flush();
    }
}
