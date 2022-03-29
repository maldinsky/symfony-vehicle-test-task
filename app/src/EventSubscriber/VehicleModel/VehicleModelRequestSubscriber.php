<?php

declare(strict_types=1);

namespace App\EventSubscriber\VehicleModel;

use App\Entity\SearchLog;
use App\Event\VehicleModel\VehicleModelFailedRequestEvent;
use App\Event\VehicleModel\VehicleModelSuccessfulRequestEvent;
use App\Logger\SearchVehicleModelLogger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VehicleModelRequestSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private SearchVehicleModelLogger $logger,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            VehicleModelSuccessfulRequestEvent::class => 'onCompletedRequest',
            VehicleModelFailedRequestEvent::class => 'onFailedRequest',
        ];
    }

    public function onCompletedRequest(VehicleModelSuccessfulRequestEvent $event): void
    {
        $vehicleModelRequestDto = $event->getVehicleModelRequestDto();

        $this->logger->info($vehicleModelRequestDto);
    }

    public function onFailedRequest(VehicleModelFailedRequestEvent $event): void
    {
        // TODO Add more actions
        $vehicleModelRequestDto = $event->getVehicleModelRequestDto();

        $this->logger->info($vehicleModelRequestDto);
    }
}
