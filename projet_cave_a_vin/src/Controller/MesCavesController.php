<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MesCavesController extends AbstractController
{
    /**
     * @Route("/user/mes_caves", name="mes_caves", methods={"GET"})
     */
    public function index(CaveRepository $caveRepository, UserInterface $user)
    {
        $userId = $user->getId();

        return $this->render('mes_caves/index.html.twig', [
            'controller_name' => 'MesCavesController',
            'caves' => $caveRepository->findByUserId($userId)
        ]);
    }
}
