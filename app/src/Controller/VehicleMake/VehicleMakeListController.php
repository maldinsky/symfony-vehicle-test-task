<?php

declare(strict_types=1);

namespace App\Controller\VehicleMake;

use App\Entity\VehicleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleMakeListController extends AbstractController
{
    #[Route(path: '/makes/{code}', name: 'vehicle_make_list')]
    public function handler(VehicleType $vehicleType): Response
    {
        return $this->render('MakeVehicle/list_makes.html.twig', [
            'vehicleType' => $vehicleType,
            'vehicleMakes' => $vehicleType->getVehicleMakes(),
        ]);
    }
}
