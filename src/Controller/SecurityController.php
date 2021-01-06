<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name = "security_registration")
     */
    function register(Request $request, EntityManagerInterface $manager){
        $user = new User();

        $form=$this->createForm(RegistrationType::class,$user); 
        
        $form->handleRequest($request);


        if ($form->isSubmitted() &&  $form->isValid()){            
                $user->setEnabled(true);
                $user->setPassword(md5($user->getPassword()));
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute('home');           
        }

        return $this->render("security/register.html.twig",[
            "registrationForm"=>$form->createView()
        ]);
    }
}
