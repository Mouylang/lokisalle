<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer, UserRepository $userRepository): Response
    {
        $isSent = false;
        $user = $this->getUser();

        if ($request->isMethod('POST')) {
            $message = $request->get('message');
            $subject = $request->get('subject');
            $recipients = $userRepository->findAllAdmins();

            $email = (new Email())
                ->from('lokisalle@flechard.fr')
                ->replyTo($user->getEmail())                          
                ->subject($subject)
                ->html('<p>Vous avez reçu un email de la part de '. $user->getFirstname().' '. $user->getLastname().' ('. $user->getEmail()  .')</p><p>' .$message. '<p>');
            foreach($recipients as $recipient){
                $email->addTo($recipient->getEmail());
            }
            $mailer->send($email);
            $isSent = true;
        }


        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'isSent' =>$isSent
        ]);
    }
}
