<?php

namespace App\Controller;


use App\Entity\Couleurs;
use App\Form\CouleursType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CouleurController extends AbstractController
{
    /**
     * @Route("/new-couleur", name="ajout_couleurs")
     */
    public function new(): Response
    {
        $couleur = new Couleurs();
        $form = $this->createForm(CouleursType::class, $couleur);

        return $this->render('couleurs/new-couleurs.html.twig',[
            'form' => $form->createView()
        ]);
    }

}
