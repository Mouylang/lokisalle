<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\OrderItem;
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
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route("/order/placeorder", name="place_order")
     */
    public function placeOrder(SessionInterface $session, ProductRepository $productRepository, EntityManagerInterface $manager ){
        $cart = $session->get('cart', new Cart());
        $ids=$cart->getAllProduct();
        if (count($ids) == 0){
            return $this->redirectToRoute('cart');
        } 
        
        $order = new Order();
        $order->setUser($this->getUser());
        $order->setCreatedAt(new \DateTime());
        $order->setTotalAmount(0);


        $manager->persist($order);


        
        foreach ($ids as $id){
            $orderItem = new OrderItem();
            $product = $productRepository->find($id);
            $orderItem->setProduct($product);
            $order->addOrderItem($orderItem);
            
            $manager->persist($orderItem);
            
        }

        $manager->flush();
        $session->remove('cart');
        return $this->redirectToRoute('order_show',[
            'id' => $order->getId()
        ]);
    }

    /**
     * @Route("/order/{id}", name="order_show")
     */
    public function show(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }


}
