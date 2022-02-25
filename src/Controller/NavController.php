<?php

namespace App\Controller;

use App\Entity\Films;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavController extends AbstractController {
    #[Route('/', name: 'accueil')]
    public function listing(ManagerRegistry $doctrine): Response 
    {
        $listing = $doctrine->getManager()->getRepository(Films::class)->findAll();

        return $this->render("accueil.html.twig", ["films" => $listing]);
    }
    
    #[Route('/seances', name: 'seances')]
    function seances() {
        return $this->render('seances.html.twig');
    }
}