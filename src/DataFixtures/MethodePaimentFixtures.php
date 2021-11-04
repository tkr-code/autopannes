<?php

namespace App\DataFixtures;

use App\Entity\PaymentMethod;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MethodePaimentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $methods = [
            'Airtel Money',
            'En Espèce',
        ];
        foreach($methods as $v)
        {
            $method = new PaymentMethod();
            $method->setDescription('description du mode de paiment à definir')
            ->setInstructions('Instruction du mode de paiement à définir')
            ->setName($v);
            $manager->persist($method);
        }
        $manager->flush();
    }
}
