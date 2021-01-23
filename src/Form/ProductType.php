<?php

namespace App\Form;

use App\Entity\Discount;
use App\Entity\Room;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('checkinAt')
            ->add('checkoutAt')
            ->add('price')
            ->add('room', EntityType::class,[
                'class'=> Room::class,
                'choice_label'=> 'title'
            ])
            ->add('discount', EntityType::class,[
                'class'=>Discount::class,
                'choice_label'=> function ($discount) {
                   return $discount->getDisplayName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
