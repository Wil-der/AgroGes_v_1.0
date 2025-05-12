<?php

namespace App\Entity;

use App\Repository\TransportacionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransportacionRepository::class)]
class Transportacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipoTransporte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $destinoCarga = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidad = null;

    #[ORM\Column(length: 255)]
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

    public function getTipoTransporte(): ?string
    {
        return $this->tipoTransporte;
    }

    public function setTipoTransporte(?string $tipoTransporte): static
    {
        $this->tipoTransporte = $tipoTransporte;

        return $this;
    }

    public function getDestinoCarga(): ?string
    {
        return $this->destinoCarga;
    }

    public function setDestinoCarga(?string $destinoCarga): static
    {
        $this->destinoCarga = $destinoCarga;

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

    public function getTipoMercancia(): ?string
    {
        return $this->tipoMercancia;
    }

    public function setTipoMercancia(string $tipoMercancia): static
    {
        $this->tipoMercancia = $tipoMercancia;

        return $this;
    }
}
