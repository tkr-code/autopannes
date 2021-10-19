<?php

namespace App\Form;

use App\Entity\Formule;
use App\Entity\PaymentMethod;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SouscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client',ClientType::class,[
                'label'=>false
            ])
            ->add('vehicule',VehiculeType::class,[
                'label'=>false
            ])
            ->add('formule',EntityType::class,[
                'class'=>Formule::class,
                'choice_label'=>function($formule){
                    return $formule->getName().' - : '.$formule->getAmount();
                }
            ])
            ->add('payment_method',EntityType::class,[
                'class'=>PaymentMethod::class,
                'choice_label'=>'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
