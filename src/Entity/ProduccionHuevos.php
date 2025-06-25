<?php

namespace App\Entity;

use App\Repository\ProduccionHuevosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduccionHuevosRepository::class)]
class ProduccionHuevos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

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

    #[ORM\Column]
    private ?int $plan = null;

    #[ORM\Column]
    private ?int $existenciaDiaria = null;

    #[ORM\Column]
    private ?int $existenciaAcumulada = null;

    #[ORM\Column]
    private ?int $existenciaAlmacen = null;

    #[ORM\Column (nullable: true)]
    private ?int $total = null;

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getPlan(): ?int
    {
        return $this->plan;
    }

    public function setPlan(?int $plan): static
    {
        $this->plan = $plan;

        return $this;
    }

    public function getExistenciaDiaria(): ?int
    {
        return $this->existenciaDiaria;
    }

    public function setExistenciaDiaria(?int $existenciaDiaria): static
    {
        $this->existenciaDiaria = $existenciaDiaria;

        return $this;
    }

    public function getExistenciaAcumulada(): ?int
    {
        return $this->existenciaAcumulada;
    }

    public function setExistenciaAcumulada(?int $existenciaAcumulada): static
    {
        $this->existenciaAcumulada = $existenciaAcumulada;

        return $this;
    }

    public function getExistenciaAlmacen(): ?int
    {
        return $this->existenciaAlmacen;
    }

    public function setExistenciaAlmacen(?int $existenciaAlmacen): static
    {
        $this->existenciaAlmacen = $existenciaAlmacen;

        return $this;
    }
}
