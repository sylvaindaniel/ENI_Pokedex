<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TypesFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pokemonTypes = [
            1 => 'Normal',
            2 => 'Feu',
            3 => 'Eau',
            4 => 'Électrique',
            5 => 'Plante',
            6 => 'Glace',
            7 => 'Combat',
            8 => 'Poison',
            9 => 'Sol',
            10 => 'Vol',
            11 => 'Psy',
            12 => 'Insecte',
            13 => 'Roche',
            14 => 'Spectre',
            15 => 'Dragon',
            16 => 'Ténèbres',
            17 => 'Acier',
            18 => 'Fée'
        ];


        foreach ( $pokemonTypes as $key => $pokemonTypeName) {
            $pokemonType = new Type();
            $pokemonType->setId($key);
            $pokemonType->setName($pokemonTypeName);

            $manager->persist($pokemonType);
        }

        $manager->flush();
    }
}
