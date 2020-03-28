<?php

namespace App\Form;

use App\Entity\Cave;
use App\Entity\Rack;
use App\Repository\RackRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',TextType::class, array('label' => 'Nom'))
            ->add('Address', TextType::class, array('label' => 'Adresse'))
            ->add('racks', EntityType::class,[
                'class' => Rack::class,
                'query_builder' => function (RackRepository $rack) {
                    return $rack->createQueryBuilder('r')
                        ->orderBy('r.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'multiple' =>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cave::class,
        ]);
    }
}
