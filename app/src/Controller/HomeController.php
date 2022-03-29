<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\VehicleTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private VehicleTypeRepository $vehicleTypeRepository,
    ) {
    }

    #[Route(path: '/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'vehicleTypes' => $this->vehicleTypeRepository->findBy([], ['code' => 'ASC']),
        ]);
    }
}
