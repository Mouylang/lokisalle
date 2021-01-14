<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Form\ProfileType;
use App\Form\SetPasswordType;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('home');
        }

        $form=$this->createForm(ProfileType::class,$user);        

        $form->handleRequest($request);

   
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'profileForm'=>$form->createView()
        ]);
    }

    /**
     * @Route("/profile/resetpassword", name="profile_resetpassword")
     */
    public function resetPassword(MailerInterface $mailer, Request $request, UserRepository $userRepository,EntityManagerInterface $manager)
    {
        $isEmailInvalid=false;
        $isAlreadySubmited=false;
        $isSuccessfullySubmited=false;

        $emailAddress = $request->get('emailAddress');

        if($emailAddress){
            $isAlreadySubmited=true;
            $user = $userRepository->findOneBy(['email'=>$emailAddress]);
            if($user){
                $datedujour = new \DateTime();
                $codeunique = md5("aléa" . $datedujour->format("D M j G:i:s T Y .u") . "toire");
                $user->setResetCode($codeunique);
                $manager->persist($user);
                $manager->flush();

                $URL_ROOT=$request->server->get('HTTP_ORIGIN');

                $email = (new Email())
                    ->from('lokisalle@flechard.fr')
                    ->to($user->getEmail())
                    ->subject('Réinitialisez votre code Lokisalle')
                    ->html("<p>Bonjour " . $user->getFirstname() . "</p><a href=\"$URL_ROOT/profile/resetpassword/$codeunique\"> cliquez ici pour reinitialiser votre mot de passe</a>");

                $mailer->send($email);


                $isSuccessfullySubmited=true;
            }else{
                $isEmailInvalid=true;
            }
        }


        return $this->render('profile/reset_password.html.twig', [
            'isEmailInvalid'=> $isEmailInvalid,
            'isAlreadySubmitted'=>$isAlreadySubmited,
            'isSuccessfullySubmited'=> $isSuccessfullySubmited
        ]);
    }

    /**
     * @Route("/profile/resetpassword/{code_unique}", name="profile_resetpassword_newpassword")
     */
    public function newPassword(MailerInterface $mailer,$code_unique,UserRepository $userRepository,Request $request,UserPasswordEncoderInterface $encoder,EntityManagerInterface $manager)
    {
        $user = $userRepository->findOneBy(['resetCode'=>$code_unique]);

        if($user){
            $newPwdForm= $this->createForm(SetPasswordType::class, $user);

            $newPwdForm->handleRequest($request);

            if($newPwdForm->isSubmitted() && $newPwdForm->isValid()){
                $hash = $encoder->encodePassword($user, $user->getPassword());  
                $user->setPassword($hash);
                $user->setResetCode(null);
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute('security_login');
            }
        }
        else{
            return $this->redirectToRoute('home');
        }

       

       return $this->render('profile/new_password.html.twig', [
        'newPwdForm'=> $newPwdForm->createView()
    ]);
        // on cherche si un utilisateur a $code_unique dans son champ "resetCode"
    }

}
