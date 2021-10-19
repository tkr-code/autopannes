<?php

namespace App\DataFixtures;

use App\Entity\Formule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormuleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $formules =
            [
                [
                    'name'=>'CONFORT PLUS',
                    'amount'=>225000
                ],
                [
                    'name'=>'MECANIC',
                    'amount'=>305500
                ],
            ];
        foreach($formules as $value)
        {
            $formule = new Formule();
            $formule->setName($value['name'])
            ->setAmount($value['amount'])
            ->setIsActive(true);

            $manager->persist($formule);
        }
        $manager->flush();
    }
}
