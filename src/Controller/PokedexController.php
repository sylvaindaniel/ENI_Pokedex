<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Notification\NotificationService;
use App\Repository\PokemonRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PokedexController extends AbstractController
{
    #[Route('/pokedex', name: 'app_pokedex')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        $pokemons = $pokemonRepository->findAll();

        return $this->render('pokedex/index.html.twig', [
            'controller_name' => 'PokedexController',
            'pokemons' => $pokemons
        ]);
    }


    #[Route('/pokedex/create', name: 'create')]
    #[isGranted("ROLE_USER")]
    public function create(EntityManagerInterface $entityManager, Request $request, NotificationService $notificationService): Response {
        $pokemon = new Pokemon();
        $pokemonForm = $this->createForm(PokemonType::class,$pokemon);

        $pokemonForm->handleRequest($request);

        if ($pokemonForm->isSubmitted() && $pokemonForm->isValid()) {
            try {
                    // Gérer l'upload de l'image
                $imageFile = $pokemonForm->get('imageFile')->getData();

                if ($imageFile) {
                    $imageName = strtolower(str_replace(' ', '', $pokemon->getName())) . '.png'; // Formatage du nom de l'image
                    $imageFile->move('assets/images', $imageName); // Déplace l'image vers le répertoire souhaité
                }
                $entityManager->persist($pokemon);
                $entityManager->flush();
                $this->addFlash('success',"Le pokémon a bien été inséré en base");
                $senderMail = $this->getParameter('mail.contact');
                $receiverMail = $this->getParameter('mail.admin');
                $notificationService->sendPokemonEmail($senderMail,$receiverMail);
                return $this->redirectToRoute('pokedex_details', ['id' => $pokemon->getId()]);
            } catch (\Exception $exception) {
                $this->addFlash('danger',"Le pokémon n'a pas été inséré en base de données");
            }
        }

        return $this->render('pokedex/create.html.twig', [
            "pokemonForm" => $pokemonForm->createView()
        ]);
    }

    #[Route('pokedex/{id}',
        name:'pokedex_details',
        requirements: ["id"=>"\d+"],
        methods: ["GET"] )]
    public function details($id, PokemonRepository $pokemonRepository): Response
    {
        $pokemon = $pokemonRepository->find($id);

        $currentDate = new DateTime();

        $captureDate = $pokemon->getCatchDay();
        $daysDiff = $currentDate->diff($captureDate)->days;
        $pokemon->setDaysDiff($daysDiff);

        return $this->render('pokedex/detail.html.twig',["pokemon" => $pokemon]);
    }

}
