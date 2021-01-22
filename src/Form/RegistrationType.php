<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('password',PasswordType::class)
            ->add('confirmPassword',PasswordType::class)
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('gender',ChoiceType::class, [
                'choices' => [
                    'Femme' => 'f',
                    'Homme' => 'm',
                ],
            ])
            ->add('city')
            ->add('zipCode')
            ->add('address')
            ->add('acceptNewletter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
