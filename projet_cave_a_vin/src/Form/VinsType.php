<?php

namespace App\Form;

use App\Entity\Vins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VinsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, array('label' => 'Nom'))
            ->add('Productor',TextType::class, array('label' => 'Producteur'))
            ->add('Appelation',TextType::class, array('label' => 'Appelation'))
            ->add('Cepage',TextType::class, array('label' => 'Cépage'))
            ->add('Milesime',TextType::class, array('label' => 'Milésime'))
            ->add('Region',TextType::class, array('label' => 'Région'))
            ->add('Couleurs')
            ->add('quantite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vins::class,
        ]);
    }
}
