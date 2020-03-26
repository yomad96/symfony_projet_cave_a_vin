<?php

namespace App\Controller;

use App\Entity\Cave;
use App\Entity\Vins;
use App\Form\VinsType;
use App\Repository\VinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
        $vin = new Vins();
        $caveId = $cave->getId();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $caveUser = $cave->getUser();
        $form = $this->createForm(VinsType::class, $vin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $vin->setCave($cave);
            $entityManager->persist($vin);
            $entityManager->flush();

            return $this->redirectToRoute('vins_index',array('id' => $cave->getId()));
        }

        if($user !== 'anon.')
        {
            $userRoles = $user->getRoles();
            if($userRoles[0] === "ROLE_USER")
            {
                $userId = $user->getId();
                if($userId !== $caveUser->getId())
                {
                    return $this->redirectToRoute('mon_profil');
                }
            }
        }
        return $this->render('vins/index.html.twig', [
            'vins' => $vinsRepository->findVinsByCaveId($caveId),
            'caveId' => $caveId,
            ]);
    }

    /**
     * @Route("/new", name="vins_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vin = new Vins();
        $form = $this->createForm(VinsType::class, $vin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vin);
            $entityManager->flush();

            return $this->redirectToRoute('vins_index');
        }

        return $this->render('vins/new.html.twig', [
            'vin' => $vin,
            'form' => $form->createView(),
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
        $form = $this->createForm(VinsType::class, $vin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vins_index');
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
        if ($this->isCsrfTokenValid('delete'.$vin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vins_index');
    }
}
