<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Room;
use App\Repository\RoomRepository;

class RoomController extends AbstractController
{
    /**
     * @Route("/room", name="room")
     */
    public function index(RoomRepository $repo): Response
    {

        $rooms = $repo->findAll();
        
        return $this->render('room/index.html.twig', [
            'rooms' => $rooms
        ]);
    }
    
    /**
     * @Route("/room/{id}", name="room_show")
     */
    public function show(Room $room ){ 

        return $this->render('room/show.html.twig', [
            'room' => $room
        ]);
    }


}
