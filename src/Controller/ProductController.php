<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(ProductRepository $productRepository): Response
    {
       $products = $productRepository->findAllAsc();
    
        return $this->render('product/index.html.twig', [
            'products' => $products

        ]);
    }

    /**
     * @Route("/product/new", name="product_create")
     * @Route("/product/{id}/edit", name="product_edit")
     */
    public function create_or_update(Product $product=null,Request $request, EntityManagerInterface $manager){
        if(!$product){
            $product = new Product();
            $product->setCheckinAt(new DateTime());
            $product->setCheckoutAt(new DateTime());
        }
        
        $form=$this->createForm(ProductType::class,$product);        

        $form->handleRequest($request);

   
        if($form->isSubmitted() && $form->isValid()){
            $product->setisSoldOut(false);
            $manager->persist($product);
            $manager->flush();
            return $this->redirectToRoute('product_show',['id' => $product->getId()]);
        }
        return $this->render('product/create.html.twig',[
            'formProduct' =>  $form->createView(),
            'editMode'=> $product->getId()!== null,

        ]);

    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/product/{id}/delete", name="product_delete")
     */
    public function delete(Product $product,EntityManagerInterface $manager){
        $manager->remove($product);
        $manager->flush();
        return $this->redirectToRoute('product');

    }

}
