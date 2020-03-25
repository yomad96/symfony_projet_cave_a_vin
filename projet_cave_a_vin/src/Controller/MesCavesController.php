<?php

namespace App\Controller;

use App\Entity\Cave;
use App\Entity\User;
use App\Form\CaveType;
use App\Repository\CaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MesCavesController extends AbstractController
{
    /**
     * @Route("/user/mes_caves", name="mes_caves", methods={"GET","POST"})
     */
    public function index(CaveRepository $caveRepository, UserInterface $user, Request $request)
    {
        $userId = $user->getId();

        $cave = new Cave();
        $form = $this->createForm(CaveType::class, $cave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user->addCave($cave);
            $entityManager->persist($cave);
            $entityManager->flush();

            return $this->redirectToRoute('mes_caves');
        }

        return $this->render('mes_caves/index.html.twig', [
            'controller_name' => 'MesCavesController',
            'caves' => $caveRepository->findByUserId($userId)
        ]);
    }
}
