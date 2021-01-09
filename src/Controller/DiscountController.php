<?php

namespace App\Controller;

use App\Entity\Discount;
use App\Form\DiscountType;
use App\Repository\DiscountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DiscountController extends AbstractController
{
    /**
     * @Route("/discount", name="discount")
     */
    public function index(DiscountRepository $repo): Response
    {

        $discounts=$repo->findAll();

        return $this->render('discount/index.html.twig', [
            'discounts' => $discounts,
        ]);
    }


       /**
     * @Route("/discount/new", name="discount_create")
     * @Route("/discount/{id}/edit", name="discount_edit")
     */
    public function create_or_update(Discount $discount=null,Request $request, EntityManagerInterface $manager){
        if(!$discount){
            $editMode=false;
            $discount = new Discount();
        }
        else{
            $editMode =true;
        }
        
        $form=$this->createForm(DiscountType::class,$discount);        

        $form->handleRequest($request);

   
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($discount);
            $manager->flush();
            return $this->redirectToRoute('discount');
        }
        return $this->render('discount/create.html.twig',[
            'formDiscount' =>  $form->createView(),
            'editMode'=> $editMode
        ]);

    }

    /**
     * @Route("/discount/{id}/delete", name="discount_delete")
     */
    public function delete(Discount $discount,EntityManagerInterface $manager){
        $manager->remove($discount);
        $manager->flush();
        return $this->redirectToRoute('discount');

    }




}
