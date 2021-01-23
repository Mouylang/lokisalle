<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsletterController extends AbstractController
{
    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function index(UserRepository $userRepository,Request $request,MailerInterface $mailer): Response
    {
        $userAcceptNewletters = $userRepository->findAllMembersAcceptNewsletter();
        $isSent = false;

        if ($request->isMethod('POST')) {
            $message = $request->get('message');
            $subject = $request->get('subject');
            
            foreach($userAcceptNewletters as $recipient){
            $email = (new Email())
                ->from('lokisalle@flechard.fr')                        
                ->subject($subject)
                ->html($message);
            
                $email->addTo($recipient->getEmail());
                $mailer->send($email);
            }
            
            $isSent = true;
        }


        return $this->render('newsletter/index.html.twig', [
            'membresNewsletters' => $userAcceptNewletters,
            'isSent'=> $isSent
        ]);
    }
}
