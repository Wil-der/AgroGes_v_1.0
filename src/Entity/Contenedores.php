<?php

namespace App\Entity;

use App\Repository\ContenedoresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenedoresRepository::class)]
class Contenedores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column(length: 255)]
    private ?string $puerto = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidad = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidadExtraida = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipoMercancia = null;

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

    public function getPuerto(): ?string
    {
        return $this->puerto;
    }

    public function setPuerto(string $puerto): static
    {
        $this->puerto = $puerto;

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

    public function getCantidadExtraida(): ?int
    {
        return $this->cantidadExtraida;
    }

    public function setCantidadExtraida(?int $cantidadExtraida): static
    {
        $this->cantidadExtraida = $cantidadExtraida;

        return $this;
    }

    public function getTipoMercancia(): ?string
    {
        return $this->tipoMercancia;
    }

    public function setTipoMercancia(?string $tipoMercancia): static
    {
        $this->tipoMercancia = $tipoMercancia;

        return $this;
    }
}
