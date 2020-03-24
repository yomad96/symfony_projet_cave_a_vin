<?php

namespace App\Controller;

use App\Entity\Cave;
use App\Form\CaveType;
use App\Repository\CaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cave")
 */
class CaveController extends AbstractController
{
    /**
     * @Route("/", name="cave_index", methods={"GET","POST"})
     */
    public function index(CaveRepository $caveRepository,Request $request): Response
    {
        $cave = new Cave();
        $form = $this->createForm(CaveType::class, $cave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cave);
            $entityManager->flush();

            return $this->redirectToRoute('cave_index');
        }

        return $this->render('cave/index.html.twig', [
            'caves' => $caveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cave_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cave = new Cave();
        $form = $this->createForm(CaveType::class, $cave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cave);
            $entityManager->flush();

            return $this->redirectToRoute('cave_index');
        }

        return $this->render('cave/new.html.twig', [
            'cave' => $cave,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cave_show", methods={"GET"})
     */
    public function show(Cave $cave): Response
    {
        return $this->render('cave/show.html.twig', [
            'cave' => $cave,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cave_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cave $cave): Response
    {
        $form = $this->createForm(CaveType::class, $cave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cave_index');
        }

        return $this->render('cave/edit.html.twig', [
            'cave' => $cave,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cave_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cave $cave): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cave->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cave);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cave_index');
    }
}
