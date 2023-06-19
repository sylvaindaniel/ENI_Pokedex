<?php

namespace App\Form;

use App\Entity\Pen;
use App\Entity\Pokemon;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('pen',
                EntityType::class,
                [
                    'class' => Pen::class,
                    'choice_label' => 'name',
                    'label' => 'Enclos',
                    'multiple' => false,
                    'required' => false
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
