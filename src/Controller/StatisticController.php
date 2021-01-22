<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatisticController extends AbstractController
{
    /**
     * @Route("/statistic", name="statistic")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findAll();

        $sumTotalAmount = 0;
        foreach($orders as $order){
            $sumTotalAmount += $order->getTotalAmount();
        }


        return $this->render('statistic/index.html.twig', [
            'orders' => $orders,
            'sumTotalAmount'=> $sumTotalAmount
        ]);
    }
    /**
     * @Route("/statistic/{id}", name="statistic_show")
     */
    public function show(Order $order): Response
    {
        return $this->render('statistic/show.html.twig', [
            'order' => $order
        ]);
    }
}
