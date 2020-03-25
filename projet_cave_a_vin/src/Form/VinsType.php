<?php

namespace App\Form;

use App\Entity\Vins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VinsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Productor')
            ->add('Appelation')
            ->add('Cepage')
            ->add('Milesime')
            ->add('Region')
            ->add('Couleurs')
            ->add('quantite')
            ->add('Cave')
            ->add('cave')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vins::class,
        ]);
    }
}
