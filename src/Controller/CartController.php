<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session,ProductRepository $productRepository,Request $request): Response
    {   
         $postedCode = $request->get('discountCode');
       
        $cart = $session->get('cart', new Cart());
        
        $ids=$cart->getAllProduct();
        $products = $productRepository->findById($ids);

        $validCode = true;
        if($postedCode != null){
            $validCode = false;
            foreach($products as $product){
                if ($product->sumbitDiscountCode($postedCode)){
                    $validCode=true;
                    $cart->addDiscountCode($postedCode);
                    $session->set('cart', $cart);
                }
            }
        }
        
        $codes = $cart->getAllDiscountCode();

        dump($codes);

        $isEmpty = count($products) == 0;
        
      


        $totalAmount = 0;
        foreach($products as $product){
            foreach($codes as $code){
                $product->sumbitDiscountCode($code);
            }
            $totalAmount += $product->getFinalPrice();

        }

    
        return $this->render('cart/index.html.twig', [
            'products' => $products,
            'totalAmount' => $totalAmount,
            'isEmpty'=> $isEmpty,
             'validCode'=>$validCode
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add(SessionInterface $session, $id){
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
