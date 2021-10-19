<?php

namespace App\Form;

use App\Entity\Mark;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque')
            ->add('serie')
            ->add('model_and_version')
            ->add('immatriculation')
            ->add('mise_en_circulation',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('puissance')
            ->add('kilometrage')
            ->add('utilisation',ChoiceType::class,[
                'choices'=>[
                    'Privé'=>'Privé',
                    'Professionnele'=>'Professionnele'
                ]
            ])
            // ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
