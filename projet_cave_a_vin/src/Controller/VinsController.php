<?php

namespace App\Controller;

use App\Entity\Cave;
use App\Entity\Couleurs;
use App\Entity\Emplacement;
use App\Entity\Quantite;
use App\Entity\Vins;

use App\Form\CouleurType;
use App\Form\VinsType;
use App\Repository\VinsRepository;
use App\Security\Voter\CaveVoter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class VinsController extends AbstractController
{
    /**
     * @Route("/{id}/vins", name="vins_index", methods={"GET","POST"})
     */
    public function index(VinsRepository $vinsRepository, Request $request, Cave $cave): Response
    {
//        $this->denyAccessUnlessGranted(CaveVoter::caveView,$cave);
        $caveId = $cave->getId();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $caveUser = $cave->getUser();
//
//        if($user !== 'anon.')
//        {
//            $userRoles = $user->getRoles();
//            if($userRoles[0] === "ROLE_USER")
//            {
//                $userId = $user->getId();
//                if($userId !== $caveUser->getId())
//                {
//                    return $this->redirectToRoute('mon_profil');
//                }
//            }
//        }
        return $this->render('vins/index.html.twig', [
            'vins' => $vinsRepository->findVinsByCaveId($caveId),
            'caveId' => $caveId
            ]);
    }

    /**
     * @Route("{id}/new", name="vins_new", methods={"GET","POST"})
     */
    public function new(Request $request, Cave $cave): Response
    {
        $vin = new Vins();
        $quantite = new Quantite();
        $emplacement = new Emplacement();
        $form = $this->createForm(VinsType::class, $vin, ['caveId' => $cave->getId()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // Ajout de la quantité dans le vin
            $vin->setCave($cave);
            $quantite->setVins($vin);
            $quantite->setQuantity($request->request->get('quantity'));
            //Ajout de l'image
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form->get('img')->getData();
            $fileName = $uploadedFile->getClientOriginalName();
            $destination = $this->getParameter('kernel.project_dir').'/public/images';
            $uploadedFile->move($destination, $fileName);
            $vin->setImg($fileName);
            $emplacementLigne = $form->get('EmplacementLigne')->getData();
            $emplacementColonne = $form->get('EmplacementColonne')->getData();
            $emplacement->setLigne($emplacementLigne);
            $emplacement->setColonne($emplacementColonne);
            $emplacement->setVin($vin);
            //Ajout en base
            $entityManager->persist($quantite);
            $entityManager->persist($vin);
            $entityManager->persist($emplacement);
            //Actualise la base de données
            $entityManager->flush();

            return $this->redirectToRoute('vins_index',array('id' => $cave->getId()));
        }

        return $this->render('vins/new.html.twig', [
            'vin' => $vin,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="vins_show", methods={"GET"})
     */
    public function show(Vins $vin): Response
    {
        return $this->render('vins/show.html.twig', [
            'vin' => $vin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vins_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vins $vin): Response
    {
        $form = $this->createForm(VinsType::class, $vin, ['caveId' => $vin->getCave()->getId()]);
        $form->handleRequest($request);
        $quantite = $vin->getQuantite();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //Ajout de l'image
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form->get('img')->getData();
            $fileName = $uploadedFile->getClientOriginalName();
            $destination = $this->getParameter('kernel.project_dir').'/public/images';
            $uploadedFile->move($destination, $fileName);
            $emplacementLigne = $form->get('EmplacementLigne')->getData();
            $emplacementColonne = $form->get('EmplacementColonne')->getData();
            $emplacement = $vin->getEmplacement();
            $emplacement->setLigne($emplacementLigne);
            $emplacement->setColonne($emplacementColonne);
            $vin->setImg($fileName);
            $quantite->setQuantity($request->request->get('quantity'));
            $vin->setQuantite($quantite);
            $entityManager->flush();
            return $this->redirectToRoute('vins_show',array('id' => $vin->getId()));
        }

        return $this->render('vins/edit.html.twig', [
            'vin' => $vin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vins_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vins $vin): Response
    {
        $cave = $vin->getCave();
        if ($this->isCsrfTokenValid('delete'.$vin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vins_index',array('id' => $cave->getId()));
    }
}
