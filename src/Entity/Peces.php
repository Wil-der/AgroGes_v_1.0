<?php

namespace App\Entity;

use App\Repository\PecesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PecesRepository::class)]
class Peces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreEntidad = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column]
    private ?int $plan = null;

    #[ORM\Column]
    private ?int $existanciaDiariaReal = null;

    #[ORM\Column]
    private ?int $existenciaacumuladaReal = null;

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

    public function getPlan(): ?int
    {
        return $this->plan;
    }

    public function setPlan(?int $plan): static
    {
        $this->plan = $plan;

        return $this;
    }

    public function getExistanciaDiariaReal(): ?int
    {
        return $this->existanciaDiariaReal;
    }

    public function setExistanciaDiariaReal(?int $existanciaDiariaReal): static
    {
        $this->existanciaDiariaReal = $existanciaDiariaReal;

        return $this;
    }

    public function getExistenciaacumuladaReal(): ?int
    {
        return $this->existenciaacumuladaReal;
    }

    public function setExistenciaacumuladaReal(?int $existenciaacumuladaReal): static
    {
        $this->existenciaacumuladaReal = $existenciaacumuladaReal;

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
}
