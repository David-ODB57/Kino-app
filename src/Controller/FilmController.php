<?php

namespace App\Controller;

use DateTime;
use App\Entity\Films;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmController extends AbstractController
{
    #[Route('/createFilm', name: 'create_film')]
    public function createFilm(Request $req, ManagerRegistry $doctrine)
    {
        $film = new Films;

        $form = $this->createFormBuilder($film)
            ->add("title", TextType::class)
            ->add("director", TextType::class)
            ->add("gender", TextType::class)
            ->add('duree', NumberType::class)
            ->add("description", TextareaType::class)
            ->add('status', TextType::class)
            ->add("image", TextType::class)
            ->add("save", SubmitType::class, ['label' => 'Créer'])
            ->getForm();

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()) {

            
            $film = $form->getData();
            $film->setCreatedAt(new DateTimeImmutable("now"));
            $film->setUpdatedAt(new DateTime("now"));
            $entityManager = $doctrine->getManager();
            $entityManager->persist($film);
            $entityManager->flush();
            
            return $this->redirectToRoute('listingFilms');
        }
        $isEditor = false;

        return $this->render('film/create.html.twig', ['form' => $form->createView(), 'isEditor' => $isEditor]);
    }
    // 
    // UPDATE FILM
    // 
    #[Route('/updateFilm/{id}', name: 'update_film')]
    public function updateFilm(Request $req, ManagerRegistry $doctrine, $id = null)
    {
        $entityManager = $doctrine->getManager();

        if(isset($id)) {

            $film = $entityManager->getRepository(Films::class)->find($id);

            if(!isset($film)) {
                return $this->redirectToRoute('listingFilms');
            }

            $isEditor = true;
        } else  {
            $film = new Films;
        }

        $form = $this->createFormBuilder($film)
            ->add("title", TextType::class)
            ->add("director", TextType::class)
            ->add("gender", TextType::class)
            ->add('duree', NumberType::class)
            ->add('description', TextareaType::class)
            ->add('status', TextType::class)
            ->add('image', TextType::class)
            ->add("save", SubmitType::class, ['label' => 'Update'])
            ->getForm();

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()) {

            $film = $form->getData();
            
            $entityManager->persist($film);
            $entityManager->flush();

            return $this->redirectToRoute('listingFilms');
        }

        return $this->render('film/create.html.twig', ['form' => $form->createView(), 'isEditor' => $isEditor]);
    }

    #[Route('/films', name: 'listingFilms')]
    public function listing(ManagerRegistry $doctrine): Response 
    {
        $listing = $doctrine->getManager()->getRepository(Films::class)->findAll();

        return $this->render("films.html.twig", ["films" => $listing]);
    }

    #[Route('/films/{id}', name: 'film_spec')]
    public function showFilm(ManagerRegistry $doctrine, int $id): Response
    {
        $film = $doctrine->getRepository(Films::class)->find($id);

        if (!$film) {
            throw $this->createNotFoundException(
                "Le film ".$id." n'est pas disponible"
            );
        }

        return new Response('Check out this great product: '.$film->getName());
    }

    #[Route('/deleteFilm/{id}', name: 'delete_film')]
    public function delete(ManagerRegistry $doctrine, $id): Response 
    {
        $entityManager = $doctrine->getManager();

        $film = $entityManager->getRepository(Films::class)->find($id);

        if(isset($film)) {
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('listingFilms');
    }

    #[Route('/resumeFilm/{id}', name: 'resume_film')]
    public function resume(ManagerRegistry $doctrine, $id): Response 
    {
        $film = $doctrine->getManager()->getRepository(Films::class)->find($id);

        return $this->render("film/resume.html.twig", ["film" => $film]);
    }
}
