<?php

declare(strict_types=1);

namespace App\Logger;

use App\Dto\VehicleModel\VehicleModelRequestDto;
use App\Entity\SearchLog;
use Doctrine\ORM\EntityManagerInterface;

class SearchVehicleModelLogger
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function info(VehicleModelRequestDto $vehicleModelRequestDto): void
    {
        $searchLog = new SearchLog(
            $vehicleModelRequestDto->vehicleMake,
            $vehicleModelRequestDto->vehicleType,
            $vehicleModelRequestDto->userIp,
            $vehicleModelRequestDto->userAgent,
            $vehicleModelRequestDto->numberModels
        );

        $this->entityManager->persist($searchLog);
        $this->entityManager->flush();
    }
}
