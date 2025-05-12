<?php

namespace App\Entity;

use App\Repository\EquipoRiegoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipoRiegoRepository::class)]
class EquipoRiego
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreEntidad = null;

    #[ORM\Column(nullable: true)]
    private ?int $enrrolladorA = null;

    #[ORM\Column(nullable: true)]
    private ?int $enrrolladorI = null;

    #[ORM\Column(nullable: true)]
    private ?int $molinoVientoA = null;

    #[ORM\Column(nullable: true)]
    private ?int $molinoVientoI = null;

    #[ORM\Column(nullable: true)]
    private ?int $riegoElectricoA = null;

    #[ORM\Column(nullable: true)]
    private ?int $riegoElectricoI = null;

    #[ORM\Column(nullable: true)]
    private ?int $equipoAbastoA = null;

    #[ORM\Column(nullable: true)]
    private ?int $equipoAbastoI = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalA = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalI = null;

    #[ORM\Column(nullable: true)]
    private ?array $total = null;

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

    public function getEnrrolladorA(): ?int
    {
        return $this->enrrolladorA;
    }

    public function setEnrrolladorA(?int $enrrolladorA): static
    {
        $this->enrrolladorA = $enrrolladorA;

        return $this;
    }

    public function getTotal(): ?array
    {
        return $this->total;
    }

    public function setTotal(?array $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getEnrrolladorI(): ?int
    {
        return $this->enrrolladorI;
    }

    public function setEnrrolladorI(?int $enrrolladorI): static
    {
        $this->enrrolladorI = $enrrolladorI;

        return $this;
    }

    public function getMolinoVientoA(): ?int
    {
        return $this->molinoVientoA;
    }

    public function setMolinoVientoA(?int $molinoVientoA): static
    {
        $this->molinoVientoA = $molinoVientoA;

        return $this;
    }

    public function getMolinoVientoI(): ?int
    {
        return $this->molinoVientoI;
    }

    public function setMolinoVientoI(?int $molinoVientoI): static
    {
        $this->molinoVientoI = $molinoVientoI;

        return $this;
    }

    public function getRiegoElectricoA(): ?int
    {
        return $this->riegoElectricoA;
    }

    public function setRiegoElectricoA(?int $riegoElectricoA): static
    {
        $this->riegoElectricoA = $riegoElectricoA;

        return $this;
    }

    public function getRiegoElectricoI(): ?int
    {
        return $this->riegoElectricoI;
    }

    public function setRiegoElectricoI(?int $riegoElectricoI): static
    {
        $this->riegoElectricoI = $riegoElectricoI;

        return $this;
    }

    public function getEquipoAbastoA(): ?int
    {
        return $this->equipoAbastoA;
    }

    public function setEquipoAbastoA(?int $equipoAbastoA): static
    {
        $this->equipoAbastoA = $equipoAbastoA;

        return $this;
    }

    public function getEquipoAbastoI(): ?int
    {
        return $this->equipoAbastoI;
    }

    public function setEquipoAbastoI(?int $equipoAbastoI): static
    {
        $this->equipoAbastoI = $equipoAbastoI;

        return $this;
    }

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
}
