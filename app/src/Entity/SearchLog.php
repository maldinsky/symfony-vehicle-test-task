<?php

namespace App\Entity;

use App\Repository\SearchLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SearchLogRepository::class)]
class SearchLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $vehicleType;

    #[ORM\Column(type: 'string', length: 255)]
    private string $vehicleMake;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $numberModels;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $requestDate;

    #[ORM\Column(type: 'string', length: 40, nullable: true)]
    private ?string $userIp;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $userAgent;

    public function __construct(
        string $vehicleType,
        string $vehicleMake,
        ?string $userIp = null,
        ?string $userAgent = null,
        ?int $numberModels = null,
    ) {
        $this->vehicleType = $vehicleType;
        $this->vehicleMake = $vehicleMake;
        $this->numberModels = $numberModels;
        $this->userIp = $userIp;
        $this->userAgent = $userAgent;
        $this->requestDate = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getVehicleType(): string
    {
        return $this->vehicleType;
    }

    public function getVehicleMake(): string
    {
        return $this->vehicleMake;
    }

    public function getNumberModels(): ?int
    {
        return $this->numberModels;
    }

    public function getUserIp(): ?string
    {
        return $this->userIp;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function getRequestDate(): \DateTimeInterface
    {
        return $this->requestDate;
    }
}
