<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('password')
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('gender',ChoiceType::class, [
                'choices' => [
                    'f' => 'f',
                    'm' => 'm',
                ],
            ])
            ->add('city')
            ->add('zipCode')
            ->add('address')
            ->add('enabled')
            ->add('acceptNewletter')
            ->add('role', EntityType::class,[
                'class'=> Role::class,
                'multiple'=>true,
                'choice_label'=> 'roleName'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
