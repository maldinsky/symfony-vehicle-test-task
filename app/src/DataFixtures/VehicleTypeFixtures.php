<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vehicleTypesJson = file_get_contents(__DIR__ . '/Resources/vehicle_types.json');
        $vehicleTypes = json_decode($vehicleTypesJson, true, 512, JSON_THROW_ON_ERROR);

        foreach ($vehicleTypes as $vehicleType) {
            $vehicleType = new VehicleType($vehicleType['code'], $vehicleType['description']);
            $manager->persist($vehicleType);
        }

        $manager->flush();
    }
}
