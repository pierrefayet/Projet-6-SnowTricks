<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Service\Attribute\Required;

class UserFixtures extends AbstractFixture
{
    private UserPasswordHasherInterface $passwordEncoder;

    #[Required]
    public function setUserPasswordHasher(UserPasswordHasherInterface $passwordEncoder): void
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 50; ++$i) {
            $user = new User();
            $user->setUserName($this->faker->word());
            $user->setEmail($this->faker->email());
            $user->setPassword($this->passwordEncoder->hashPassword($user, 'TEST'));
            $user->setUserImage('');
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
            $this->addReference('users' . $i, $user);
        }

        $userCustom = new User();
        $userCustom->setUserName($this->faker->word());
        $userCustom->setEmail($this->faker->email());
        $userCustom->setPassword($this->passwordEncoder->hashPassword($user, 'TEST'));
        $userCustom->setUserImage('');
        $userCustom->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $this->addReference('userCustom', $userCustom);

        $manager->flush();
    }
}
