<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Room;
use App\Form\RoomType;
use App\Entity\Product;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\RoomRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    public function create_or_update(Room $room = null, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger)
    {
        if (!$room) {
            $room = new Room();
        }

        $form = $this->createForm(RoomType::class, $room);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $photoFile = $form->get('photo')->getData();

            if ($photoFile) {

                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                
                //la foncion slug enleve les caractères spéciaux du ficher envoyer pour que cela puisse fonctionner dans une URL
                $safeFilename = $slugger->slug($originalFilename);
                //la fonctgion uniqid génère un id unique aléatoire 
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();

                // Move the file to the directory where brochures are stored
               
                $photoFile->move(
                        //on indique où on va stocker la photo dans notre server
                        $this->getParameter('photo_directory'),
                        $newFilename
                    );
                    
                //on enregistre l'adresse du fichier en base
                $room->setPhoto('/uploads/photos/' . $newFilename);
            }

            $manager->persist($room);
            $manager->flush();
            return $this->redirectToRoute('room_show', ['id' => $room->getId()]);
        }
        return $this->render('room/create.html.twig', [
            'formRoom' =>  $form->createView(),
            'editMode' => $room->getId() !== null,
            'title' => $room->getTitle()

        ]);
    }

    /**
     * @Route("/room/{id}", name="room_show")
     */
    public function show(Room $room, Request $request, EntityManagerInterface $manager)
    {

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            $comment->setCreatedAt(new \DateTime());
            $comment->setRoom($room);
            $comment->setAuthor($user);
            $manager->persist($comment);

            $manager->flush();
            return $this->redirectToRoute('room_show', ['id' => $room->getId()]);
        }


        return $this->render('room/show.html.twig', [
            'room' => $room,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/room/{id}/delete", name="room_delete")
     */
    public function delete(Room $room, EntityManagerInterface $manager)
    {
        $manager->remove($room);
        $manager->flush();
        return $this->redirectToRoute('room');
    }
}
