<?php

namespace App\Entity;

use App\Repository\CentroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CentroRepository::class)]
class CentroHuevos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $plan = null;

    #[ORM\Column(nullable: true)]
    private ?int $existenciaDiaria = null;

    #[ORM\Column(nullable: true)]
    private ?int $existenciaAcumulada = null;

    #[ORM\Column(nullable: true)]
    private ?int $existenciaAlmacen = null;

    #[ORM\ManyToOne(inversedBy: 'centros')]
    private ?Entidad $entidad = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEntidad(): ?Entidad
    {
        return $this->entidad;
    }

    public function setEntidad(?Entidad $entidad): static
    {
        $this->entidad = $entidad;

        return $this;
    }
}
