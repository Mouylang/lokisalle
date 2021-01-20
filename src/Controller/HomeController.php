<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\ProductRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepository,CommentRepository $commentRepository): Response
    {
        $products = $productRepository->findNext3availableProducts();

        $comments = $commentRepository->findLast3Comments();

        return $this->render('home/index.html.twig',[
            'products' => $products,
            'comments' => $comments

        ]);
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

    /**
     * @Route("/home/plansite.html.twig", name="home_plansite")
     */
    public function plansite(): Response
    {
        return $this->render('home/plansite.html.twig');
    }

    
}
