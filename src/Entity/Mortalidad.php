<?php

namespace App\Entity;

use App\Repository\MortalidadRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MortalidadRepository::class)]
class Mortalidad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreEntidad = null;

    #[ORM\Column]
    private ?int $conejoHoy = null;

    #[ORM\Column]
    private ?int $conejoAcumulado = null;

    
    #[ORM\Column]
    private ?int $vacunoHoy = null;

    #[ORM\Column]
    private ?int $vacunoAcumulado = null;

    #[ORM\Column]
    private ?int $ovinohoy = null;

    #[ORM\Column]
    private ?int $ovinoAcumulado = null;

    #[ORM\Column]
    private ?int $porcinoHoy = null;

    #[ORM\Column]
    private ?int $porcinoAcumulado = null;

    #[ORM\Column]
    private ?int $equinoHoy = null;

    #[ORM\Column]
    private ?int $equinoAcumulado = null;

    #[ORM\Column (nullable: true)]
    private ?int $totalA = null;

    #[ORM\Column (nullable: true)]
    private ?int $totalI = null;

    public function getTotalA(): ?int
    {
        return $this->totalA;
    }

    public function setTotalA(?int $totalA): static
    {
        $this->totalA = $totalA;

        return $this;
    }

    public function getTotalI(): ?int
    {
        return $this->totalI;
    }

    public function setTotalI(?int $totalI): static
    {
        $this->totalI = $totalI;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): static
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getNombreEntidad(): ?string
    {
        return $this->nombreEntidad;
    }

    public function setNombreEntidad(string $nombreEntidad): static
    {
        $this->nombreEntidad = $nombreEntidad;

        return $this;
    }

    public function getVacunoHoy(): ?int
    {
        return $this->vacunoHoy;
    }

    public function setVacunoHoy(?int $vacunoHoy): static
    {
        $this->vacunoHoy = $vacunoHoy;

        return $this;
    }

    public function getVacunoAcumulado(): ?int
    {
        return $this->vacunoAcumulado;
    }

    public function setVacunoAcumulado(?int $vacunoAcumulado): static
    {
        $this->vacunoAcumulado = $vacunoAcumulado;

        return $this;
    }

    public function getOvinohoy(): ?int
    {
        return $this->ovinohoy;
    }

    public function setOvinohoy(?int $ovinohoy): static
    {
        $this->ovinohoy = $ovinohoy;

        return $this;
    }

    public function getOvinoAcumulado(): ?int
    {
        return $this->ovinoAcumulado;
    }

    public function setOvinoAcumulado(?int $ovinoAcumulado): static
    {
        $this->ovinoAcumulado = $ovinoAcumulado;

        return $this;
    }

    public function getPorcinoHoy(): ?int
    {
        return $this->porcinoHoy;
    }

    public function setPorcinoHoy(?int $porcinoHoy): static
    {
        $this->porcinoHoy = $porcinoHoy;

        return $this;
    }

    public function getPorcinoAcumulado(): ?int
    {
        return $this->porcinoAcumulado;
    }

    public function setPorcinoAcumulado(?int $porcinoAcumulado): static
    {
        $this->porcinoAcumulado = $porcinoAcumulado;

        return $this;
    }

    public function getEquinoHoy(): ?int
    {
        return $this->equinoHoy;
    }

    public function setEquinoHoy(?int $equinoHoy): static
    {
        $this->equinoHoy = $equinoHoy;

        return $this;
    }

    public function getEquinoAcumulado(): ?int
    {
        return $this->equinoAcumulado;
    }

    public function setEquinoAcumulado(?int $equinoAcumulado): static
    {
        $this->equinoAcumulado = $equinoAcumulado;

        return $this;
    }

    public function getConejoHoy(): ?int
    {
        return $this->conejoHoy;
    }

    public function setConejoHoy(?int $conejoHoy): static
    {
        $this->conejoHoy = $conejoHoy;

        return $this;
    }

    public function getConejoAcumulado(): ?int
    {
        return $this->conejoAcumulado;
    }

    public function setConejoAcumulado(?int $conejoAcumulado): static
    {
        $this->conejoAcumulado = $conejoAcumulado;

        return $this;
    }
}
