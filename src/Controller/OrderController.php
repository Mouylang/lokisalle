<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $user = $this->getUser();
        $orders = $orderRepository->fingByUser($user);

        return $this->render('order/index.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/order/placeorder", name="place_order")
     */
    public function placeOrder(SessionInterface $session, ProductRepository $productRepository, EntityManagerInterface $manager ){
        //on récupère le panier dans la session
        $cart = $session->get('cart', new Cart());
        //on récupère les ids de chaque produit de mon panier 
        $ids=$cart->getAllProduct();

        //securité en cas d'accès direct à la route avec une panier vide
        if (count($ids) == 0){
            return $this->redirectToRoute('cart');
        } 
        // si on arrive la, mon panier n'est pas vide
        
        //on crée une nouvelle commande
        $order = new Order();
        //on va chercher id user pour ajouter dans la commande
        $order->setUser($this->getUser());
        //on va créer une nouvelle date grace à la fonction datetime qui va retourner la date du jour et l'heure puis d'ajouter dans la commande
        $order->setCreatedAt(new \DateTime());
        
       // $manager->persist($order);
        //on initialise le montant total à 0
        $totalAmount = 0;
        //on recupère tous les codes promos (qui ont été postés et validés à un moment donné dans la session)
        $codes = $cart->getAllDiscountCode();
        //on va soumettre pour chaque produit tous les codes qui ont été mis dans le panier
        foreach ($ids as $id){
            $orderItem = new OrderItem();

            //on va récupérer l'objet produit qui a l'identifiant id
            $product = $productRepository->find($id);
            
            foreach($codes as $code){
                //si un des codes est valide le produit s'en souviendra grace à la variable usediscount qui sera à true
                $product->sumbitDiscountCode($code);
            }
            //on ajoute le prix du produit avec une fonction qui contient une certaine réduction
            $totalAmount += $product->getFinalPrice();

            //on associe le produit à cet orderitem
            $orderItem->setProduct($product);

            // on met l'order item dans la commande
            $order->addOrderItem($orderItem);
           
            //on prépare sa mise en base de donné
            $manager->persist($orderItem);
            
        }

        $order->setTotalAmount($totalAmount);

        $manager->persist($order);
        
        $manager->flush();
        $session->remove('cart');
        return $this->redirectToRoute('order_show',[
            'id' => $order->getId()
        ]);
    }

    /**
     * @Route("/order/{id}", name="order_show")
     */
    public function show(Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order
        ]);
    }


}
