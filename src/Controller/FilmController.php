<?php

namespace App\Controller;

use App\Entity\Films;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'create_film')]
    public function createFilm(ManagerRegistry $doctrine): Response 
    {
        $entityManager = $doctrine->getManager();
        $film = new Films;
        $film->setTitle('Freddy');
        $film->setDirector('Wes Craven');
        $film->setGender('Horreur');

        $entityManager->persist($film);
        $entityManager->flush();

        return new Response('Un nouveau film a été créé '.$film->getTitle());
    }

    #[Route('/listing', name: 'listingFilms')]
    public function listing(ManagerRegistry $doctrine): Response 
    {
        $listing = $doctrine->getManager()->getRepository(Films::class)->findAll();

        return $this->render("films.html.twig", ["films" => $listing]);
    }
}
