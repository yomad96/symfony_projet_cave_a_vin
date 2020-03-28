<?php

namespace App\Form;

use App\Entity\Cave;
use App\Entity\Rack;
use App\Repository\CaveRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('ligneTotal')
            ->add('colonneTotal')
            ->add('cave',EntityType::class, [
                "class" => Cave::class,
                'query_builder' => function (CaveRepository $cave) {
                    return $cave->createQueryBuilder('c')
                        ->orderBy('c.id', 'ASC');
                },
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rack::class,
        ]);
    }
}
