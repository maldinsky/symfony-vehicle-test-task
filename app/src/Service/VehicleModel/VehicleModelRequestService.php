<?php

declare(strict_types=1);

namespace App\Service\VehicleModel;

use App\Dto\VehicleModel\VehicleModelRequestDto;
use App\Event\VehicleModel\VehicleModelSuccessfulRequestEvent;
use App\Repository\VehicleMakeRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class VehicleModelRequestService
{
    public function __construct(
        private VehicleMakeRepository $vehicleMakeRepository,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function getVehicleModels(VehicleModelRequestDto $vehicleModelRequestDto): Collection
    {
        $vehicleModels = $this->vehicleMakeRepository->findOneByTypeAndMake(
            $vehicleModelRequestDto->vehicleType,
            $vehicleModelRequestDto->vehicleMake,
        )?->getVehicleModels();

        if (null === $vehicleModels) {
            throw new \DomainException('Not found');
        }

        $vehicleModelRequestDto->numberModels = $vehicleModels->count();

        $this->eventDispatcher->dispatch(
            new VehicleModelSuccessfulRequestEvent($vehicleModelRequestDto)
        );

        return $vehicleModels;
    }
}
