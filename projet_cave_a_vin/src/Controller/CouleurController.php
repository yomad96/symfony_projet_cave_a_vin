<?php

namespace App\Controller;


use App\Entity\Couleurs;
use App\Form\CouleurType;
use App\Repository\CouleursRepository;
use App\Security\Voter\CouleursVoter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CouleurController extends AbstractController
{

    /**
     * @Route("/couleurs", name="couleurs_index")
     */
    public function index(CouleursRepository $couleursRepository, Request $request)
    {
        $couleur = new Couleurs();
        $this->denyAccessUnlessGranted(CouleursVoter::COULEUR_VIEW, $couleur);
        $form = $this->createForm(CouleurType::class, $couleur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($couleur);
            $entityManager->flush();
        }

        return $this->render('couleurs/index.html.twig',[
            'couleurs' => $couleursRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new-couleur", name="ajout_couleurs")
     */
    public function new(): Response
    {
        $couleur = new Couleurs();
        $form = $this->createForm(CouleurType::class, $couleur);

        return $this->render('couleurs/new-couleurs.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete-couleur/{id}", name="couleurs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Couleurs $couleurs): Response
    {
        if ($this->isCsrfTokenValid('delete'.$couleurs->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($couleurs->getVins() as $vin)
            {
                $couleurs->removeVin($vin);
            }
            $entityManager->remove($couleurs);
            $entityManager->flush();
        }

        return $this->redirectToRoute('couleurs_index');
    }

}
