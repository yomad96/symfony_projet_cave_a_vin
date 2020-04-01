<?php

namespace App\Form;


use App\Entity\Couleurs;
use App\Entity\Rack;
use App\Entity\Vins;
use App\Repository\CouleursRepository;
use App\Repository\RackRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VinsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $caveId = $options['caveId'];
        $arrayLigne = [0,1,2,3,4,5,6,7,8,9,10];
        $arrayColonne = [0,1,2,3,4,5,6,7,8,9,10];
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
            ->add('Rack', EntityType::class,[
                'class' => Rack::class,
                'query_builder' => function (RackRepository $rack) use ($caveId) {
                    return $rack->findRackByCaveId($caveId);
                },
                'choice_label' => 'nom',
                ])
            ->add('EmplacementLigne', ChoiceType::class, [
                'label' => 'Ligne',
                'choices' => $arrayLigne,
            ])
            ->add('EmplacementColonne', ChoiceType::class,[
                'label' => 'Colonne',
                'choices' => $arrayColonne,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vins::class,
            'caveId' => 0,
            'allow_extra_fields' => true
        ]);

        $resolver->setRequired('caveId'); // Requires that currentOrg be set by the caller.
        $resolver->setAllowedTypes('caveId', 'int');
    }
}
