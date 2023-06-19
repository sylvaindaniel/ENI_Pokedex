<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokedexController extends AbstractController
{
    #[Route('/pokedex', name: 'app_pokedex')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        $pokemons = $pokemonRepository->findAll();
        $currentDate = new DateTime();

        foreach ($pokemons as $pokemon) {
            $captureDate = $pokemon->getCatchDay();
            $daysDiff = $currentDate->diff($captureDate)->days;
            $pokemon->setDaysDiff($daysDiff);
        }

        return $this->render('pokedex/index.html.twig', [
            'controller_name' => 'PokedexController',
            'pokemons' => $pokemons
        ]);
    }



    #[Route('/pokedex/create', name: 'create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response {
        $pokemon = new Pokemon();
        $pokemonForm = $this->createForm(PokemonType::class,$pokemon);

        $pokemonForm->handleRequest($request);

        if ($pokemonForm->isSubmitted() && $pokemonForm->isValid()) {
            try {
                $entityManager->persist($pokemon);
                $entityManager->flush();
                $this->addFlash('success',"Le pokémon a bien été inséré en base");
            } catch (\Exception $exception) {
                $this->addFlash('danger',"Le pokémon n'a pas été inséré en base de données");
            }
        }

        return $this->render('pokedex/create.html.twig', [
            "pokemonForm" => $pokemonForm->createView()
        ]);
    }

}
