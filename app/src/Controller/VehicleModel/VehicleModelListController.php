<?php

declare(strict_types=1);

namespace App\Controller\VehicleModel;

use App\Dto\VehicleModel\VehicleModelRequestDto;
use App\Event\VehicleModel\VehicleModelFailedRequestEvent;
use App\Service\VehicleModel\VehicleModelRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class VehicleModelListController extends AbstractController
{
    public function __construct(
        private VehicleModelRequestService $vehicleModelRequestService,
        private EventDispatcherInterface $eventDispatcher,
        private SerializerInterface $serializer,
    ) {
    }

    #[Route(path: '/makes/{vehicleType}/{vehicleMake}', name: 'vehicle_model_list', methods: ['GET'])]
    public function handler(VehicleModelRequestDto $vehicleModelRequestDto): Response
    {
        try {
            $vehicleModels = $this->vehicleModelRequestService->getVehicleModels($vehicleModelRequestDto);
        } catch (\Exception) {
            $this->eventDispatcher->dispatch(
                new VehicleModelFailedRequestEvent($vehicleModelRequestDto)
            );

            return new JsonResponse(
                [],
                Response::HTTP_BAD_REQUEST
            );
        }

        return JsonResponse::fromJsonString($this->serializer->serialize($vehicleModels->toArray(), 'json', [
            AbstractNormalizer::ATTRIBUTES => [
                'code',
                'description',
            ],
        ]));
    }
}
