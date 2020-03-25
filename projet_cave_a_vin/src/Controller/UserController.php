<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="user_inscription")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new user();

        $form = $this->createForm(RegistrationType::class, $user);

        //Analyse la requête
        $form->handleRequest($request);
        //Si le formulaire est valide et que le formulaire est soumis
        if($form->isSubmitted()&&$form->isValid())
        {
            //hash le password en fonction de l'algorithme dans le fichier security.yaml
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setRoles('ROLE_USER');
            //Récupère le $user et l'ajoute à la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('cave_index');
        }

        return $this->render('user/registration.html.twig',[
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/connexion", name="user_connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('user/connexion.html.twig',[
            'error'=> $error
        ]);
    }

    /**
     * @Route("/deconnexion", name="user_deconnexion" )
     */
    public function logout(){}
}
