<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController {
    /**
     * @Route("/", name="index")
     */
    // function index() {
    //     $liList = ['Home','Blog','Contact'];
    //     return $this->render('index.html.twig', ['liList' => $liList]);
    // }

    /**
     * @Route("/profile/{id}", name="profile")
     */
    function profile($id) {
        dd($id);
    }

    /**
     * @Route("/salle/{num}", name="salle")
     */
    function salle($num) {
        dd("Salle numéro $num");
    }

    /**
     * @Route("/age/{age?2}", name="age", requirements={"age"="\d+"})
     */
    function age($age) {
        // dd("Age: $age");
        $liList = ['Home','Blog','Contact'];
        return $this->render('index.html.twig', ['age' => $age, 'liList' => $liList]);
    }
}