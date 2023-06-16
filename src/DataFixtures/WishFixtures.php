<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WishFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pokemonNames = [
            'Pikachu', 'Charizard', 'Bulbasaur', 'Squirtle', 'Jigglypuff',
            'Snorlax', 'Eevee', 'Gyarados', 'Mewtwo', 'Dragonite', 'Blastoise',
            'Arcanine', 'Alakazam', 'Gengar', 'Machamp', 'Lapras', 'Vaporeon',
            'Flareon', 'Jolteon', 'Aerodactyl', 'Golem', 'Mew', 'Zapdos', 'Articuno',
            'Moltres', 'Raichu', 'Venusaur', 'Butterfree', 'Pidgeot', 'Rhydon', 'Sandslash',
            'Nidoking', 'Nidoqueen', 'Clefable', 'Ninetales', 'Kingdra', 'Tyranitar',
            'Ampharos', 'Steelix', 'Heracross', 'Houndoom', 'Lugia', 'Ho-Oh',
            'Celebi', 'Suicune', 'Entei', 'Raikou', 'Metagross', 'Salamence', 'Rayquaza'
        ];

        $faker = Factory::create();

        foreach ( $pokemonNames as $pokemonName) {
            $pokemon = new Pokemon();
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
