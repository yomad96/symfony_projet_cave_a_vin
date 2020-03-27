<?php

namespace App\Form;

use App\Entity\Couleurs;
use App\Entity\Vins;
use App\Repository\CouleursRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('couleurs',EntityType::class, [
                "class" => Couleurs::class,
                'query_builder' => function (CouleursRepository $couleur) {
                    return $couleur->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
            ])
            ->add('img', FileType::class,[
                'data_class' => null
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vins::class,
        ]);
    }
}
