<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationType;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="user_inscription")
     */
    public function registration(Request$request)
    {
        $user = new user();

        $form = $this->createForm(RegistrationType::class, $user);

        //Analyse la requête
        $form->handleRequest($request);
        //Si le formulaire est valide et que le formulaire est soumis
        if($form->isSubmitted()&&$form->isValid())
        {
            //Récupère le $user et l'ajoute à la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('user/registration.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
