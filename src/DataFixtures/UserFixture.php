<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@test.com');
        $user->setPhone('123123123');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setActive('1');
        $user->setFirstname('jan');
        $user->setSurname('nowak');
        $user->setNip('123123123');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'Tester123'));
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('noadmin@test.com');
        $user2->setPhone('123123123');
        $user2->setActive('1');
        $user2->setFirstname('jan');
        $user2->setSurname('nowak');
        $user2->setNip('123123123');
        $user2->setPassword($this->passwordHasher->hashPassword($user, 'Tester123'));

        $manager->persist($user2);
        $manager->flush();
    }
}
