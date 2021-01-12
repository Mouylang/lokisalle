<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/home/cgv.html.twig", name="home_cgv")
     */
    public function cgv(): Response
    {
        return $this->render('home/cgv.html.twig');
    }

    /**
     * @Route("/home/mentionslegales.html.twig", name="home_mentionslegales")
     */
    public function mentionslegales(): Response
    {
        return $this->render('home/mentionslegales.html.twig');
    }

    
}
