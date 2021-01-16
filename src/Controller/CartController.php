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
        //on récupère le code promo en methode post la valeur tapée par le membre
        $postedCode = $request->get('discountCode');

       //on récupère l'objet panier depuis la session 
        $cart = $session->get('cart', new Cart());
        
        //on récupère toutes ids de chaque produit dans le panier
        $ids=$cart->getAllProduct();

     
        //on recupère les objets Product dont les identifiants sont passés en paramètre
        
        $products = $productRepository->findById($ids);

        // on compte le nombre de product pour savoir si le panier est vide
        if(count($products) == 0){
            $isEmpty=true;
        }else{
            $isEmpty=false;
        }
       
        $validCode = true;       
        
        if($postedCode){ //si on a posté un code

            // on initialise le validcode à false
            $validCode = false;

            //on soumet le code à chaque produit de la liste
            foreach($products as $product){

                if ($product->sumbitDiscountCode($postedCode)){
                    //si la code promo posté correspond bien au code promo associé au produit $product
                    $validCode=true;
                    $cart->addDiscountCode($postedCode);
                    //on sauvegarder le panier dans la session
                    $session->set('cart', $cart);
                }
            }
        }


        //on recupère tous les codes promos (qui ont été postés et validés à un moment donné dans la session)
        $codes = $cart->getAllDiscountCode();

        //calcul du prix
        $totalAmount = 0;
        //on va soumettre pour chaque produit tous les codes qui ont été mis dans le panier
        foreach($products as $product){
            foreach($codes as $code){
                //si un des codes est valide le produit s'en souviendra grace à la variable usediscount qui sera à true
                $product->sumbitDiscountCode($code);
            }
            //on ajoute le prix du produit avec une fonction qui contient une certaine réduction
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
