<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('personne',PersonneType::class,[
                'label'=>false
            ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'placeholder'=>'Email'
                ]
            ])
            ->add('address',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Adresse'
                ]
            ])
            ->add('postal_code',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Code postal'
                ]
            ])
            ->add('hbd_day',DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('phone_number',NumberType::class,[
                'attr'=>[
                    'placeholder'=>'Numéro de portable'
                ]
            ])
            ->add('city',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Ville'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
