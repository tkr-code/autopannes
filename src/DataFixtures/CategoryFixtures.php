<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categorys = 
            [
                'Citadine','Berline','Break','Monospace','Pick-up','Coupé','4x4, SUV, Crossover'
            ];
        foreach ($categorys as $value)
        {
            $category = new Category();
            $category->setTitle($value);
            $category->setIsActive(true);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
