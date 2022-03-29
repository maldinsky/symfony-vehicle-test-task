<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\VehicleModel;
use App\Repository\VehicleMakeRepository;
use App\Repository\VehicleTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VehicleModelFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private VehicleTypeRepository $vehicleTypeRepository,
        private VehicleMakeRepository $vehicleMakeRepository,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $vehicleModelsJson = file_get_contents(__DIR__ . '/Resources/models.json');
        $vehicleModels = json_decode($vehicleModelsJson, true, 512, JSON_THROW_ON_ERROR);

        foreach ($vehicleModels as $vehicleModel) {
            $vehicleType = $this->vehicleTypeRepository->find($vehicleModel['type']);
            $vehicleMake = $this->vehicleMakeRepository->findOneBy([
                'vehicleType' => $vehicleType?->getCode(),
                'code' => $vehicleModel['group'],
            ]);

            if(null !== $vehicleType && null !== $vehicleMake) {
                $make = new VehicleModel(
                    $vehicleModel['code'],
                    $vehicleType,
                    $vehicleMake,
                    $vehicleModel['description']
                );
                $manager->persist($make);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VehicleMakeFixtures::class,
            VehicleTypeFixtures::class,
        ];
    }
}
