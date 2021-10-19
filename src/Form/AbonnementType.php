<?php

namespace App\Form;
use App\Entity\Formule;
use App\Entity\PaymentMethod;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Abonnement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnementType extends AbstractType
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
            ->add('payment',PaymentMethodAbonnementType::class,[
                'label'=>false
            ])
            // ->add('created_at')
            // ->add('end_at',DateType::class,[
            //     'widget'=>'single_text'
            // ])
            // ->add('etat')
            // ->add('payment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
