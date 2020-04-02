<?php

namespace App\Controller;

use App\Repository\CaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MonProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="mon_profil")
     */
    public function index(UserInterface $user, CaveRepository $caveRepository)
    {
        $array = [];
        $userId = $user->getId();
        $caves = $caveRepository->findByUserId($userId);
        foreach ($caves as $cave)
        {
            $vins = $cave->getVins();
            foreach ($vins as $vin)
            {
                $vinQte = $vin->getQuantite();
                array_push($array, $vinQte->getQuantity());
            }

        }


        return $this->render('mon_profil/index.html.twig', [
            'controller_name' => 'DashboardController',
            'caves' => $caves,
            'array' => $array

        ]);
    }
}
