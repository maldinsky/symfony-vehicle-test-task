<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ModelRepository;
use App\Repository\VehicleModelRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: VehicleModelRepository::class)]
class VehicleModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $code;

    #[ORM\ManyToOne(targetEntity: VehicleType::class, inversedBy: 'vehicleModels')]
    #[ORM\JoinColumn(name: 'type', referencedColumnName: 'code')]
    #[Ignore]
    private VehicleType $vehicleType;

    #[ORM\ManyToOne(targetEntity: VehicleMake::class, inversedBy: 'vehicleModels')]
    #[ORM\JoinColumn(name: 'make')]
    #[Ignore]
    private VehicleMake $vehicleMake;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    public function __construct(string $code, VehicleType $vehicleType, VehicleMake $vehicleMake, ?string $description)
    {
        $this->code = $code;
        $this->vehicleType = $vehicleType;
        $this->vehicleMake = $vehicleMake;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getVehicleType(): VehicleType
    {
        return $this->vehicleType;
    }

    public function getVehicleMake(): VehicleMake
    {
        return $this->vehicleMake;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
