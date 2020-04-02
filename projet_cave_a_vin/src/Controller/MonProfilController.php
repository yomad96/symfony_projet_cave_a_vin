<?php

namespace App\Controller;

use App\Repository\CaveRepository;
use PhpParser\Node\Expr\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use function Sodium\add;

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
            $total = 0;
            $vins = $cave->getVins();
            foreach ($vins as $vin)
            {
                $total = $total + $vin->getQuantite()->getQuantity();
            }
            array_push($array,[$cave->getName() => $total]);
        }


        return $this->render('mon_profil/index.html.twig', [
            'controller_name' => 'DashboardController',
            'caves' => $caves,
            'array' => $array,
            'totalVin' => $this->getTotalVin($array)

        ]);
    }

    protected function getTotalVin(array $arrayTotal)
    {
        $totalVin = 0;
        foreach ($arrayTotal as $value)
        {
            foreach ($value as $val)
            {
                $totalVin = $totalVin + $val;
            }
        }
        return $totalVin;
    }
}
