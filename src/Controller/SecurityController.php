<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name = "security_registration")
     */
    function register(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder,RoleRepository $roleRepository){
        $user = new User();

        $form=$this->createForm(RegistrationType::class,$user); 
        
        $form->handleRequest($request);


        if ($form->isSubmitted() &&  $form->isValid()){       
                $hash = $encoder->encodePassword($user, $user->getPassword());  
                $user->setPassword($hash);
                $role_membre = $roleRepository->findOneBy(['roleName' => 'ROLE_MEMBER']);
                $user->addRole($role_membre);
                $user->setEnabled(true);

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('security_login');     

        }

        return $this->render("security/register.html.twig",[
            "registrationForm"=>$form->createView()
        ]);
    }

    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils){

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'error' => $error,
            'lastUsername'=> $lastUsername
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){
        
    }




}
