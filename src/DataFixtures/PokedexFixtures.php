<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PokedexFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $pokemonNames = [
            1 => 'Pikachu',
            2 => 'Dracaufeu',
            3 => 'Bulbizarre',
            4 => 'Carapuce',
            5 => 'Rondoudou',
            6 => 'Ronflex',
            7 => 'Évoli',
            8 => 'Léviator',
            9 => 'Mewtwo',
            10 => 'Dracolosse',
            11 => 'Tortank',
            12 => 'Arcanin',
            13 => 'Alakazam',
            14 => 'Ectoplasma',
            15 => 'Mackogneur',
            16 => 'Lokhlass',
            17 => 'Aquali',
            18 => 'Pyroli',
            19 => 'Voltali',
            20 => 'Ptéra',
            21 => 'Grolem',
            22 => 'Mew',
            23 => 'Électhor',
            24 => 'Artikodin',
            25 => 'Sulfura',
            26 => 'Raichu',
            27 => 'Florizarre',
            28 => 'Papilusion',
            29 => 'Roucarnage',
            30 => 'Rhinoféros',
            31 => 'Sablaireau',
            32 => 'Nidoking',
            33 => 'Nidoqueen',
            34 => 'Mélodelfe',
            35 => 'Feunard',
            36 => 'Hyporoi',
            37 => 'Tyranocif',
            38 => 'Pharamp',
            39 => 'Steelix',
            40 => 'Scarhino',
            41 => 'Démolosse',
            42 => 'Lugia',
            43 => 'Ho-Oh',
            44 => 'Celebi',
            45 => 'Suicune',
            46 => 'Entei',
            47 => 'Raikou',
            48 => 'Métalosse',
            49 => 'Drattak',
            50 => 'Rayquaza'
        ];


        $faker = Factory::create();

        foreach ( $pokemonNames as $key => $pokemonName) {
            $pokemon = new Pokemon();
            $pokemon->setId($key);
            $pokemon->setName($pokemonName);
            $pokemon->setCatchDay($faker->dateTimeBetween('-1 year'));
            $pokemon->setCatchPlace($faker->city);
            $pokemon->setLevel($faker->numberBetween(1, 100));
            $pokemon->setHp($faker->numberBetween(50, 500));
            $pokemon->setShiny($faker->boolean);

            $manager->persist($pokemon);
        }

        $manager->flush();
    }


}
