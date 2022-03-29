<?php

declare(strict_types=1);

namespace App\Event\VehicleModel;

use App\Dto\VehicleModel\VehicleModelRequestDto;
use Symfony\Contracts\EventDispatcher\Event;

class VehicleModelFailedRequestEvent extends Event
{
    public function __construct(
        private VehicleModelRequestDto $vehicleModelRequestDto,
    ) {
    }

    public function getVehicleModelRequestDto(): VehicleModelRequestDto
    {
        return $this->vehicleModelRequestDto;
    }
}
