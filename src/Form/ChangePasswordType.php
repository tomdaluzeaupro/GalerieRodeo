<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'mon adresse email' 
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'mon penom'
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => 'mon nom'
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'mon mot de passe actuelle ',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'veuillez saisir votre mot de passe actuelle'
                ]
            ])
            ->add('new_plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent etre identique.',
                'required' => true,
                'first_options' => ['label' => 'Votre nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Nouveau mot de passe',
                    'label' => 'Nouveau Mot de passe'
                ],
                ],
                'second_options' => ['label' => 'Confirmez Votre nouveau Mot de passe',
                'attr' => [
                    'placeholder' => 'Confirmation du nouveau Mot de passe',
                    'label' => 'Confirmez nouveau votre Mot de passe'
                ]],

            ])
            ->add('submit', SubmitType::class, [
                'label' => "metrre a jour"
            ])

            

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
