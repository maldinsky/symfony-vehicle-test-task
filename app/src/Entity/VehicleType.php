<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\VehicleTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleTypeRepository::class)]
class VehicleType
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 255)]
    private string $code;

    #[ORM\Column(type: 'text', nullable: true)]
    private string $description;

    #[ORM\OneToMany(mappedBy: 'vehicleType', targetEntity: VehicleMake::class)]
    private Collection $vehicleMakes;

    #[ORM\OneToMany(mappedBy: 'vehicleType', targetEntity: VehicleModel::class)]
    private Collection $vehicleModels;

    public function __construct(string $code, ?string $description = null)
    {
        $this->code = $code;
        $this->description = $description;
        $this->vehicleMakes = new ArrayCollection();
        $this->vehicleModels = new ArrayCollection();
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getVehicleMakes(): Collection
    {
        return $this->vehicleMakes;
    }

    public function getVehicleModels(): Collection
    {
        return $this->vehicleModels;
    }
}
