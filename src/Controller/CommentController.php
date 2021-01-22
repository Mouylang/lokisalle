<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment", name="comment")
     */
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findAll();
        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/comment/{id}/delete", name="comment_delete")
     */
    public function delete(Comment $comment,EntityManagerInterface $manager){
        $manager->remove($comment);
        $manager->flush();
        return $this->redirectToRoute('comment');

    }
}
