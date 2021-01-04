<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/room/new", name="room_create")
     * @Route("/room/{id}/edit", name="room_edit")
     */
    public function create_or_update(Room $room=null,Request $request, EntityManagerInterface $manager){
        if(!$room){
            $room = new Room();
        }
        
        $form=$this->createForm(RoomType::class,$room);        

        $form->handleRequest($request);

   
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($room);
            $manager->flush();
            return $this->redirectToRoute('room_show',['id' => $room->getId()]);
        }
        return $this->render('room/create.html.twig',[
            'formRoom' =>  $form->createView(),
            'editMode'=> $room->getId()!== null,
            'title'=> $room->getTitle()

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
