<?php

namespace App\DataFixtures;

use App\Datas\SpecieList;
use App\Entity\Specie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SpeciesFixture extends Fixture implements DependentFixtureInterface
{

    public static function getReferenceKey($id){
        return sprintf('specie_%s', $id);
    }

    public function load(ObjectManager $manager): void
    {

        foreach ( SpecieList::$species as $key => $specieElement) {
            $pokemonSpecie = new Specie();
            $pokemonSpecie->setId($key);
            $pokemonSpecie->setNumber($specieElement['number']);
            $pokemonSpecie->setName($specieElement['name']);


            $typeIds = $specieElement['typeIds'];
            foreach ($typeIds as $typeId) {
              $type = $this->getReference(TypesFixture::getReferenceKey($typeId));
              $pokemonSpecie->addType($type);
            }

            $manager->persist($pokemonSpecie);
            $this->addReference(self::getReferenceKey($key), $pokemonSpecie);

        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            TypesFixture::class
        ];
    }


}
