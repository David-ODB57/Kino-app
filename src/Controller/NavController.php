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
        return $this->render('films.html.twig');
    }

    /**
     * @Route("/seances", name="seances")
     */
    function seances() {
        return $this->render('seances.html.twig');
    }
}