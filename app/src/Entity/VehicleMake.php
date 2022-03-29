<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\VehicleMakeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'make')]
#[ORM\Entity(repositoryClass: VehicleMakeRepository::class)]
#[ORM\UniqueConstraint(columns: ['code', 'type'])]
class VehicleMake
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $code;

    #[ORM\ManyToOne(targetEntity: VehicleType::class, inversedBy: 'vehicleMakes')]
    #[ORM\JoinColumn(name: 'type', referencedColumnName: 'code')]
    private VehicleType $vehicleType;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\OneToMany(mappedBy: 'vehicleMake', targetEntity: VehicleModel::class)]
    private Collection $vehicleModels;

    public function __construct(string $code, VehicleType $vehicleType, ?string $description = null)
    {
        $this->code = $code;
        $this->vehicleType = $vehicleType;
        $this->description = $description;
        $this->vehicleModels = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getVehicleModels(): Collection
    {
        return $this->vehicleModels;
    }
}
