<?php

namespace App\Form;

use App\Entity\Pen;
use App\Entity\Pokemon;
use App\Entity\Specie;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('catchDay')
            ->add('catchPlace')
            ->add('level')
            ->add('hp')
            ->add('shiny')
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => 'Image du Pokémon',
                'mapped' => false,
            ])
            ->add('specie',EntityType::class,
                [
                    'class' => Specie::class,
                    'choice_label' => 'name',
                    'label' => 'Choisir une espèce',
                    'multiple' => false,
                    'required' => true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
