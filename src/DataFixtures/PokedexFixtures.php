<?php

namespace App\DataFixtures;

use App\Datas\PokedexList;
use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PokedexFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            SpeciesFixture::class
        ];
    }
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        foreach (PokedexList::$pokemons as $pokemonElement) {
            $pokemon = new Pokemon();
//          $pokemon->setId($pokemonElement['id']);
            $pokemon->setName($pokemonElement['name']);
            $pokemon->setCatchDay($faker->dateTimeBetween('-1 year'));
            $pokemon->setCatchPlace($faker->city);
            $pokemon->setLevel($faker->numberBetween(1, 100));
            $pokemon->setHp($faker->numberBetween(50, 500));
            $pokemon->setShiny($faker->boolean);

            $specie = $this->getReference(SpeciesFixture::getReferenceKey($pokemonElement['specieId']));

            $pokemon->setSpecie($specie);
            $manager->persist($pokemon);

        }

        $manager->flush();
    }


}
