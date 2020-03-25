<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MesCavesController extends AbstractController
{
    /**
     * @Route("/mes_caves", name="mes_caves")
     */
    public function index()
    {
        return $this->render('mes_caves/index.html.twig', [
            'controller_name' => 'MesCavesController',
        ]);
    }
}
