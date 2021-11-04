<?php

namespace App\Form;

use App\Entity\Formule;
use App\Entity\Mark;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Marque',
                    'class'=>'text-uppercase'
                ]
            ])
            ->add('serie',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Serie'
                ]
            ])
            ->add('model_and_version',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Mode et version'
                ]
            ])
            ->add('immatriculation',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Immatriculation',
                    'class'=>'text-uppercase'
                ]
            ])
            ->add('mise_en_circulation',DateType::class,[
                'widget'=>'single_text',
                'attr'=>[
                    'placeholder'=>'Mise en circulation'
                ]
            ])
            ->add('puissance',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Puissance'
                ]
            ])
            ->add('kilometrage',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Kilometrage'
                ]
            ])
            ->add('utilisation',ChoiceType::class,[
                'choices'=>[
                    'Privé'=>'Privé',
                    'Professionnele'=>'Professionnele'
                ]
            ])
            ->add('formule',EntityType::class,[
                'class'=>Formule::class,
                'choice_label'=>function($formule){
                    return $formule->getName().' - : '.$formule->getAmount();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
