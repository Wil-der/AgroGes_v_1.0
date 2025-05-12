<?php

namespace App\Entity;

use App\Repository\MaquinaIngenieraRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaquinaIngenieraRepository::class)]
class MaquinaIngeniera
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
    private ?int $buldocerA = null;

    #[ORM\Column(nullable: true)]
    private ?int $buldocerI = null;

    #[ORM\Column(nullable: true)]
    private ?int $cargadorA = null;

    #[ORM\Column(nullable: true)]
    private ?int $cargadorI = null;

    #[ORM\Column(nullable: true)]
    private ?int $excavadorA = null;

    #[ORM\Column(nullable: true)]
    private ?int $excavadorI = null;

    #[ORM\Column(nullable: true)]
    private ?int $autoGruaA = null;

    #[ORM\Column(nullable: true)]
    private ?int $autoGruaI = null;

    #[ORM\Column(nullable: true)]
    private ?int $geA = null;

    #[ORM\Column(nullable: true)]
    private ?int $geI = null;

    #[ORM\Column(nullable: true)]
    private ?int $motoNiveladoraA = null;

    #[ORM\Column(nullable: true)]
    private ?int $motoNiveladoraI = null;

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

    public function getBuldocerA(): ?int
    {
        return $this->buldocerA;
    }

    public function setBuldocerA(?int $buldocerA): static
    {
        $this->buldocerA = $buldocerA;

        return $this;
    }

    public function getBuldocerI(): ?int
    {
        return $this->buldocerI;
    }

    public function setBuldocerI(?int $buldocerI): static
    {
        $this->buldocerI = $buldocerI;

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

    public function getCargadorA(): ?int
    {
        return $this->cargadorA;
    }

    public function setCargadorA(?int $cargadorA): static
    {
        $this->cargadorA = $cargadorA;

        return $this;
    }

    public function getCargadorI(): ?int
    {
        return $this->cargadorI;
    }

    public function setCargadorI(?int $cargadorI): static
    {
        $this->cargadorI = $cargadorI;

        return $this;
    }

    public function getExcavadorA(): ?int
    {
        return $this->excavadorA;
    }

    public function setExcavadorA(?int $excavadorA): static
    {
        $this->excavadorA = $excavadorA;

        return $this;
    }

    public function getExcavadorI(): ?int
    {
        return $this->excavadorI;
    }

    public function setExcavadorI(?int $excavadorI): static
    {
        $this->excavadorI = $excavadorI;

        return $this;
    }

    public function getAutoGruaA(): ?int
    {
        return $this->autoGruaA;
    }

    public function setAutoGruaA(?int $autoGruaA): static
    {
        $this->autoGruaA = $autoGruaA;

        return $this;
    }

    public function getAutoGruaI(): ?int
    {
        return $this->autoGruaI;
    }

    public function setAutoGruaI(?int $autoGruaI): static
    {
        $this->autoGruaI = $autoGruaI;

        return $this;
    }

    public function getGeA(): ?int
    {
        return $this->geA;
    }

    public function setGeA(?int $geA): static
    {
        $this->geA = $geA;

        return $this;
    }

    public function getGeI(): ?int
    {
        return $this->geI;
    }

    public function setGeI(?int $geI): static
    {
        $this->geI = $geI;

        return $this;
    }

    public function getMotoNiveladoraA(): ?int
    {
        return $this->motoNiveladoraA;
    }

    public function setMotoNiveladoraA(?int $motoNiveladoraA): static
    {
        $this->motoNiveladoraA = $motoNiveladoraA;

        return $this;
    }

    public function getMotoNiveladoraI(): ?int
    {
        return $this->motoNiveladoraI;
    }

    public function setMotoNiveladoraI(?int $motoNiveladoraI): static
    {
        $this->motoNiveladoraI = $motoNiveladoraI;

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
