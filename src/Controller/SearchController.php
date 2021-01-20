<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(ProductRepository $productRepository,Request $request): Response
    {
        $products = null;
        $isPost=false;
        
        if($request->isMethod('POST')){
            $category = $request->get('category');
            $checkinAt = $request->get('checkin_at');
            $checkoutAt = $request->get('checkout_at');
            $capacity = $request->get('capacity');
            $price = $request->get('prix');
            $products = $productRepository->findByCategory($category,$price,$checkinAt,$checkoutAt,$capacity);
            $isPost = true;

        }
        
        
        

        return $this->render('search/index.html.twig', [
            'products' => $products,
            'isPost' => $isPost
        ]);

    }
}
