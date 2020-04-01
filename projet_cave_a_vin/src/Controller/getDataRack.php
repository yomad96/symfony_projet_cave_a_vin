<?php


namespace App\Controller;


use App\Repository\RackRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class getDataRack extends AbstractController
{
    /**
     * @Route("/request/getDataRack")
     *
     */
    public function getDataRack(RackRepository $rackRepository) :JsonResponse
    {
        $rackId = $_GET['rack'];
        $rackId_Integer = (int)$rackId;
        $rack = $rackRepository->find($rackId_Integer);
        $rackLigneTotal = $rack->getLigneTotal();
        $rackColonneTotal = $rack->getColonneTotal();
        $arrayRack = [$rackLigneTotal,$rackColonneTotal];
        return new JsonResponse($arrayRack);
    }

}
