<?php

namespace App\Entity;

use App\Repository\HechosExtraordinariosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HechosExtraordinariosRepository::class)]
class HechosExtraordinarios
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
    private ?int $acumuladosAnos = null;

    #[ORM\Column]
    private ?int $hsgMayorMenor = null;

    #[ORM\Column]
    private ?int $hgMayorMenor = null;

    #[ORM\Column]
    private ?int $hurtoRoboViolencia = null;

    #[ORM\Column]
    private ?int $hurtoRoboFuerza = null;

    #[ORM\Column]
    private ?int $hurtoRoboOtros = null;

    #[ORM\Column]
    private ?int $Arma = null;

    #[ORM\Column]
    private ?int $municion = null;

    #[ORM\Column]
    private ?int $accidenteTrabajo = null;

    #[ORM\Column]
    private ?int $accidenteTransito = null;

    #[ORM\Column]
    private ?int $muertos = null;

    #[ORM\Column]
    private ?int $heridos = null;

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

    public function getAcumuladosAnos(): ?int
    {
        return $this->acumuladosAnos;
    }

    public function setAcumuladosAnos(?int $acumuladosAnos): static
    {
        $this->acumuladosAnos = $acumuladosAnos;

        return $this;
    }

    public function getHsgMayorMenor(): ?int
    {
        return $this->hsgMayorMenor;
    }

    public function setHsgMayorMenor(?int $hsgMayorMenor): static
    {
        $this->hsgMayorMenor = $hsgMayorMenor;

        return $this;
    }

    public function getHgMayorMenor(): ?int
    {
        return $this->hgMayorMenor;
    }

    public function setHgMayorMenor(?int $hgMayorMenor): static
    {
        $this->hgMayorMenor = $hgMayorMenor;

        return $this;
    }

    public function getHurtoRoboViolencia(): ?int
    {
        return $this->hurtoRoboViolencia;
    }

    public function setHurtoRoboViolencia(?int $hurtoRoboViolencia): static
    {
        $this->hurtoRoboViolencia = $hurtoRoboViolencia;

        return $this;
    }

    public function getHurtoRoboFuerza(): ?int
    {
        return $this->hurtoRoboFuerza;
    }

    public function setHurtoRoboFuerza(?int $hurtoRoboFuerza): static
    {
        $this->hurtoRoboFuerza = $hurtoRoboFuerza;

        return $this;
    }

    public function getHurtoRoboOtros(): ?int
    {
        return $this->hurtoRoboOtros;
    }

    public function setHurtoRoboOtros(?int $hurtoRoboOtros): static
    {
        $this->hurtoRoboOtros = $hurtoRoboOtros;

        return $this;
    }

    public function getArma(): ?int
    {
        return $this->Arma;
    }

    public function setArma(?int $Arma): static
    {
        $this->Arma = $Arma;

        return $this;
    }

    public function getMunicion(): ?int
    {
        return $this->municion;
    }

    public function setMunicion(?int $municion): static
    {
        $this->municion = $municion;

        return $this;
    }

    public function getAccidenteTrabajo(): ?int
    {
        return $this->accidenteTrabajo;
    }

    public function setAccidenteTrabajo(?int $accidenteTrabajo): static
    {
        $this->accidenteTrabajo = $accidenteTrabajo;

        return $this;
    }

    public function getAccidenteTransito(): ?int
    {
        return $this->accidenteTransito;
    }

    public function setAccidenteTransito(?int $accidenteTransito): static
    {
        $this->accidenteTransito = $accidenteTransito;

        return $this;
    }

    public function getMuertos(): ?int
    {
        return $this->muertos;
    }

    public function setMuertos(?int $muertos): static
    {
        $this->muertos = $muertos;

        return $this;
    }

    public function getHeridos(): ?int
    {
        return $this->heridos;
    }

    public function setHeridos(?int $heridos): static
    {
        $this->heridos = $heridos;

        return $this;
    }
}
