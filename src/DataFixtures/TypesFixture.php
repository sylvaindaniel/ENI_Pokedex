<?php

namespace App\DataFixtures;

use App\Datas\TypeList;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypesFixture extends Fixture
{

    public static function getReferenceKey($id){
        return sprintf('type_%s', $id);
    }
    public function load(ObjectManager $manager): void
    {
//        $pokemonTypes = [
//            1 => 'Normal',
//            2 => 'Feu',
//            3 => 'Eau',
//            4 => 'Électrique',
//            5 => 'Plante',
//            6 => 'Glace',
//            7 => 'Combat',
//            8 => 'Poison',
//            9 => 'Sol',
//            10 => 'Vol',
//            11 => 'Psy',
//            12 => 'Insecte',
//            13 => 'Roche',
//            14 => 'Spectre',
//            15 => 'Dragon',
//            16 => 'Ténèbres',
//            17 => 'Acier',
//            18 => 'Fée'
//        ];


        foreach ( TypeList::$pokemonTypes as $key => $typeElement) {
            $pokemonType = new Type();
            $pokemonType->setId($key);
            $pokemonType->setName($typeElement);

            $manager->persist($pokemonType);
            $this->addReference(self::getReferenceKey($key),$pokemonType);

        }

        $manager->flush();
    }
}
