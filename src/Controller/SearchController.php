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
        $isPost = false;
        $category= null;
        $city = null;
        $capacity = null;
        $checkinAtAfter = null;
        $checkinAtBefore = null;
        $price = null;
        $keyword = null;


        
        if($request->isMethod('POST')){
            
            $category = $request->get('category');
            $city = $request->get('city');
            $capacity = $request->get('capacity');
            $checkinAtAfter = $request->get('checkinAtAfter');
            $checkinAtBefore = $request->get('checkinAtBefore');
            $price = $request->get('price');
            $keyword = $request->get('keyword');

            

                $products = $productRepository->findByCriteria($category,$price,$city,$checkinAtAfter,$checkinAtBefore,$capacity,$keyword);
                $isPost = true;

        }
        
        
        

        return $this->render('search/index.html.twig', [
            'products' => $products,
            'isPost' => $isPost,
            'city'=> $city,
            'category'=> $category,
            'capacity'=> $capacity,
            'checkinAtAfter'=> $checkinAtAfter,
            'checkinAtBefore'=>$checkinAtBefore,
            'price'=>$price,
            'keyword'=>$keyword

        ]);

    }
}
