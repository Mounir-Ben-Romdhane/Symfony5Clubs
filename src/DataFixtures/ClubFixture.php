<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClubFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1 ; $i <= 10 ; $i++){
            $club = new Club();
            $club->setNom("Club title : ".$i);
            $club->setDiscription("Club discription : ".$i);
            $club->setAdresse("Club adresse : ".$i);
            $club->setDomaine("Club domaine : ".$i);
            $manager->persist($club);

        }

        $manager->flush();
    }
}
