<?php

namespace App\Form;

use App\Entity\Abonnement;
use App\Entity\Formule;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnemntEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created_at',DateType::class,[
                'label'=>'Date de debut',
                'widget'=>'single_text',
                'attr'=>
                    [
                        'disabled'=>true
                    ]
            ])
            ->add('end_at',DateType::class,[
                'label'=>'Date de fin',
                'widget'=>'single_text',
                'attr'=>[
                    'disabled'=>true
                ]
            ])
            ->add('etat',ChoiceType::class,[
                'choices'=>Abonnement::etats,
            ])
            ->add('formule',EntityType::class,[
                'class'=>Formule::class,
                'choice_label'=>function($formule){
                    return $formule->getName().' - : '.$formule->getAmount();
                }
            ])
            // ->add('formule')
            // ->add('vehicule')
            // ->add('payment')
            // ->add('client')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
