<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Room;
use App\Repository\RoomRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
     */
    public function create(){
        $room = new Room();

        $formBuilder = $this->createFormBuilder($room);
        $formBuilder->add('title', TextType::class, [
            'attr'=>[
                'placeholder'=> 'saisir un titre'
            ]
        ]);
        $formBuilder->add('country');
        $formBuilder->add('city');
        $formBuilder->add('address');
        $formBuilder->add('zipCode');
        $formBuilder->add('description');
        $formBuilder->add('photo');
        $formBuilder->add('capacity');
        $formBuilder->add('category');
        $form=$formBuilder->getForm();
        $formView = $form->createView();
 
        return $this->render('room/create.html.twig',[
            'formRoom' =>  $formView
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
