<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(Request $request,ProductRepository $productRepository): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', new Cart());
        $ids=$cart->getAllProduct();

        $products = $productRepository->findById($ids);

        $isEmpty = count($products) == 0;

        $totalAmount = 0;
        foreach($products as $product){
            $totalAmount += $product->getPrice();
        }


        return $this->render('cart/index.html.twig', [
            'products' => $products,
            'totalAmount' => $totalAmount,
            'isEmpty'=> $isEmpty
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add( Request $request, $id){
        $session = $request->getSession();
        $cart = $session->get('cart', new Cart());
        $cart->addProduct($id);
        $session->set('cart', $cart);

         return $this->redirectToRoute('cart');

    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove( Request $request, $id){
        $session = $request->getSession();
        $cart = $session->get('cart', new Cart());
        $cart->removeProduct($id);
        $session->set('cart', $cart);

         return $this->redirectToRoute('cart');

    }


}
