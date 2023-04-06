<?php

namespace App\Controller;

// Importation des classes nécessaires pour le fonctionnement du contrôleur
use App\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

// Déclaration de la classe AccountPasswordController qui hérite d'AbstractController
class AccountPasswordController extends AbstractController
{
    // Création d'une route nommée "account_password" et définie par l'URL "/compte/modifier-mon-mot-de-passe"
    #[Route('/compte/modifier-mon-mot-de-passe', name: 'account_password')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Récupération de l'utilisateur actuellement connecté
        $user = $this->getUser();
        
        // Création d'un formulaire de type ChangePasswordType lié à l'utilisateur connecté
        $form = $this->createForm(ChangePasswordType::class, $user);

        // Gestion de la soumission du formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération de l'ancien mot de passe soumis par l'utilisateur
            $old_pwd = $form->get('old_password')->getData();

            // Vérification si l'ancien mot de passe est valide
            if ($passwordHasher->isPasswordValid($user, $old_pwd)) {
                // Récupération du nouveau mot de passe soumis par l'utilisateur
                $new_pwd = $form->get('new_password')->getData();

                // Hachage et mise à jour du mot de passe de l'utilisateur
                $password = $passwordHasher->hashPassword($user, $new_pwd);

                // À ce stade, vous devez enregistrer le mot de passe mis à jour dans la base de données
            }
        }

        // Affichage du formulaire de modification du mot de passe dans le template "account/password.html.twig"
        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
