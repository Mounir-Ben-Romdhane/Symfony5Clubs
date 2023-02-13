<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $password_hashed = $this->passwordEncoder->encodePassword($user,"mounir123");
        $user->setUsername("Mounir2000");
        $user->setEmail("mounirbenben9@gmail.com");
        $user->setPassword($password_hashed);
        $manager->persist($user);

        $manager->flush();
    }
}
