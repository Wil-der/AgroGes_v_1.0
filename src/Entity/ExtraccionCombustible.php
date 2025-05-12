<?php

namespace App\Entity;

use App\Repository\ExtraccionCombustibleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExtraccionCombustibleRepository::class)]
class ExtraccionCombustible
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipoCombustible = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lugarExtraccion = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidad = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $destino = null;

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

    public function getTipoCombustible(): ?string
    {
        return $this->tipoCombustible;
    }

    public function setTipoCombustible(?string $tipoCombustible): static
    {
        $this->tipoCombustible = $tipoCombustible;

        return $this;
    }

    public function getLugarExtraccion(): ?string
    {
        return $this->lugarExtraccion;
    }

    public function setLugarExtraccion(?string $lugarExtraccion): static
    {
        $this->lugarExtraccion = $lugarExtraccion;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getDestino(): ?string
    {
        return $this->destino;
    }

    public function setDestino(string $destino): static
    {
        $this->destino = $destino;

        return $this;
    }
}
