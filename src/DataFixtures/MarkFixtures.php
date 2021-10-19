<?php

namespace App\DataFixtures;

use App\Entity\Mark;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarkFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $marques =
            [
                'RENAULT','PEUGEOT','CITROEN','BMW','VOLKSWAGEN',
                'ABARTH'
            ] ;
            foreach ($marques as $key => $value) {
                $mark = new Mark();
                $mark->setName($value);
                $manager->persist($mark);
            }

        $manager->flush();
    }
}
