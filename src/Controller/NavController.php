<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController {
    /**
     * @Route("/", name="accueil")
     */
    function accueil() {
        return $this->render('accueil.html.twig');
    }

    /**
     * @Route("/films", name="films")
     */
    function films() {
        $films = [
                    "Les Dents de la mer",
                    "Shining",
                    "Ghostbusters",
                    "Chucky",
                    "Star Wars",
                    "Indiana Jones"
        ];
        return $this->render('films.html.twig', ["films" => $films]);
    }

    /**
     * @Route("/seances", name="seances")
     */
    function seances() {
        return $this->render('films.html.twig');
    }
}