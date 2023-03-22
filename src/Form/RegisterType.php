<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' => 'Prenom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30, 
                ]),
                // cree un placeholder avec attr
                'attr' => [
                    'placeholder' => 'Saissisez votre prenom'
                ]
            ])

            ->add('lastname', TextType::class,[
                'label' => 'Votre nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30, 
                ]),
            'attr' => [
                'placeholder' => 'Saisissez votre nom'
            ]
            ])

            ->add('email', EmailType::class,[
                'label' => 'Votre Email',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30, 
                ]),
                'attr' => [
                    'placeholder' => 'Saisissez votre nom'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent etre identique.',
                'required' => true,
                'first_options' => ['label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'label' => 'Votre Mot de passe'
                ],
                ],
                'second_options' => ['label' => 'Confirmez Votre Mot de passe',
                'attr' => [
                    'placeholder' => 'Confirmation du Mot de passe',
                    'label' => 'Confirmez Votre Mot de passe'
                ]],

            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
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
