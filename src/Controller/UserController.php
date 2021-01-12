<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
            
        ]);
    }


    /**
     * @Route("/user/new", name="user_create")
     * @Route("/user/{id}/edit", name="user_edit")
     */
    public function create_or_update(User $user=null,Request $request, EntityManagerInterface $manager){
        if(!$user){
            $user = new User();
        }
        
        $form=$this->createForm(UserType::class,$user);        

        $form->handleRequest($request);

   
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('user');
        }
        return $this->render('user/create.html.twig',[
            'formUser' =>  $form->createView(),
            'editMode'=> $user->getId()!== null

        ]);

    }



}
