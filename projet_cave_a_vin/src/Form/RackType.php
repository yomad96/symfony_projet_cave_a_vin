<?php

namespace App\Form;

use App\Entity\Cave;
use App\Entity\Rack;
use App\Repository\CaveRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $arrayLigne = [0,1,2,3,4,5,6,7,8,9,10];
        $arrayColonne = [0,1,2,3,4,5,6,7,8,9,10];
        $builder
            ->add('nom')
            ->add('ligneTotal',ChoiceType::class,[
                'choices' => $arrayLigne,
                'label' => 'Nombre de ligne du rack'
            ])
            ->add('colonneTotal', ChoiceType::class, [
                'choices' => $arrayColonne,
                'label' => 'Nombre de colonne du rack'
            ])
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
