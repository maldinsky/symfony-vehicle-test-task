<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\VehicleMake;
use App\Repository\VehicleMakeRepository;
use App\Repository\VehicleTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VehicleMakeFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private VehicleTypeRepository $vehicleTypeRepository,
        private VehicleMakeRepository $vehicleMakeRepository,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $vehicleMakesJson = file_get_contents(__DIR__ . '/Resources/makes.json');
        $vehicleMakes = json_decode($vehicleMakesJson, true, 512, JSON_THROW_ON_ERROR);

        foreach ($vehicleMakes as $vehicleMake) {
            $vehicleType = $this->vehicleTypeRepository->find($vehicleMake['type']);
            $vehicleMakeOld = $this->vehicleMakeRepository->findOneBy([
                'vehicleType' => $vehicleType?->getCode(),
                'code' => $vehicleMake['code'],
            ]);

            if (null !== $vehicleType && null === $vehicleMakeOld) {
                $vehicleMake = new VehicleMake($vehicleMake['code'], $vehicleType, $vehicleMake['description']);
                $manager->persist($vehicleMake);

                $manager->flush();
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VehicleTypeFixtures::class,
        ];
    }
}
