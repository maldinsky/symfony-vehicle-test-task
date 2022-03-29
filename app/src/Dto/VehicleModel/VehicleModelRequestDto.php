<?php

declare(strict_types=1);

namespace App\Dto\VehicleModel;

use Nelexa\RequestDtoBundle\Dto\ConstructRequestObjectInterface;
use Symfony\Component\HttpFoundation\Request;

class VehicleModelRequestDto implements ConstructRequestObjectInterface
{
    public string $vehicleType;
    public string $vehicleMake;
    public string $userIp;
    public string $userAgent;
    public ?int $numberModels = null;

    public function __construct(Request $request)
    {
        $this->vehicleType = $request->get('vehicleType');
        $this->vehicleMake = $request->get('vehicleMake');
        $this->userIp = $request->getClientIp();
        $this->userAgent = $request->headers->get('User-Agent');
    }
}
