<?php

namespace App\Entity;

use App\Repository\PiensoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiensoRepository::class)]
class Pienso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreEntidad = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column(nullable: true)]
    private ?int $avicolaPlan = null;

    #[ORM\Column(nullable: true)]
    private ?int $avicolaReal = null;

    #[ORM\Column(nullable: true)]
    private ?int $avicolaCovertura = null;

    #[ORM\Column(nullable: true)]
    private ?int $porcinoPlan = null;

    #[ORM\Column(nullable: true)]
    private ?int $porcinoReal = null;

    #[ORM\Column(nullable: true)]
    private ?int $porcinoCovertura = null;

    #[ORM\Column(nullable: true)]
    private ?int $piensoLiquidoPlan = null;

    #[ORM\Column(nullable: true)]
    private ?int $piensoLiquidoAcumuladoDia = null;

    #[ORM\Column(nullable: true)]
    private ?int $piensoLiquidoReal = null;

    #[ORM\Column(nullable: true)]
    private ?int $extraccionMateriaPrimaDia = null;

    #[ORM\Column(nullable: true)]
    private ?int $extraccionMateriaPrimaAcumulada = null;

    #[ORM\Column(nullable: true)]
    private ?array $total = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAvicolaPlan(): ?int
    {
        return $this->avicolaPlan;
    }

    public function setAvicolaPlan(?int $avicolaPlan): static
    {
        $this->avicolaPlan = $avicolaPlan;

        return $this;
    }

    public function getAvicolaReal(): ?int
    {
        return $this->avicolaReal;
    }

    public function setAvicolaReal(?int $avicolaReal): static
    {
        $this->avicolaReal = $avicolaReal;

        return $this;
    }

    public function getAvicolaCovertura(): ?int
    {
        return $this->avicolaCovertura;
    }

    public function setAvicolaCovertura(?int $avicolaCovertura): static
    {
        $this->avicolaCovertura = $avicolaCovertura;

        return $this;
    }

    public function getPorcinoPlan(): ?int
    {
        return $this->porcinoPlan;
    }

    public function setPorcinoPlan(?int $porcinoPlan): static
    {
        $this->porcinoPlan = $porcinoPlan;

        return $this;
    }

    public function getPorcinoReal(): ?int
    {
        return $this->porcinoReal;
    }

    public function setPorcinoReal(?int $porcinoReal): static
    {
        $this->porcinoReal = $porcinoReal;

        return $this;
    }

    public function getPorcinoCovertura(): ?int
    {
        return $this->porcinoCovertura;
    }

    public function setPorcinoCovertura(?int $porcinoCovertura): static
    {
        $this->porcinoCovertura = $porcinoCovertura;

        return $this;
    }

    public function getPiensoLiquidoPlan(): ?int
    {
        return $this->piensoLiquidoPlan;
    }

    public function setPiensoLiquidoPlan(?int $piensoLiquidoPlan): static
    {
        $this->piensoLiquidoPlan = $piensoLiquidoPlan;

        return $this;
    }

    public function getPiensoLiquidoAcumuladoDia(): ?int
    {
        return $this->piensoLiquidoAcumuladoDia;
    }

    public function setPiensoLiquidoAcumuladoDia(?int $piensoLiquidoAcumuladoDia): static
    {
        $this->piensoLiquidoAcumuladoDia = $piensoLiquidoAcumuladoDia;

        return $this;
    }

    public function getPiensoLiquidoReal(): ?int
    {
        return $this->piensoLiquidoReal;
    }

    public function setPiensoLiquidoReal(?int $piensoLiquidoReal): static
    {
        $this->piensoLiquidoReal = $piensoLiquidoReal;

        return $this;
    }

    public function getExtraccionMateriaPrimaDia(): ?int
    {
        return $this->extraccionMateriaPrimaDia;
    }

    public function setExtraccionMateriaPrimaDia(?int $extraccionMateriaPrimaDia): static
    {
        $this->extraccionMateriaPrimaDia = $extraccionMateriaPrimaDia;

        return $this;
    }

    public function getExtraccionMateriaPrimaAcumulada(): ?int
    {
        return $this->extraccionMateriaPrimaAcumulada;
    }

    public function setExtraccionMateriaPrimaAcumulada(?int $extraccionMateriaPrimaAcumulada): static
    {
        $this->extraccionMateriaPrimaAcumulada = $extraccionMateriaPrimaAcumulada;

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

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): static
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
