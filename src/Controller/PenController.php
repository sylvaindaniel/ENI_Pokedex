<?php

namespace App\Controller;

use App\Entity\Pen;
use App\Repository\PenRepository;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PenController extends AbstractController
{
    #[Route('/pen', name: 'pen')]
    public function create(EntityManagerInterface $entityManager,  PokemonRepository $pokemonlRepository): Response
    {
        $pen = new Pen();
//        $fifi = $pokemonlRepository->find(152);
        $pen->setName("le box pabo");
        $pen->setNumber("2222");
        $pen->setSurface("100");

        $entityManager->persist($pen);
        $entityManager->flush($pen);


        return $this->render('pen/index.html.twig', [
            'controller_name' => 'PenController',
        ]);
    }


    #[Route('/pen/list', name: 'list')]
    public function index(PenRepository $penRepository): Response
    {
            $pens = $penRepository->findAll();
             return $this->render('pen/index.html.twig',[
             'pens' => $pens ]);
    }
}
