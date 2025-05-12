<?php

namespace App\Entity;

use App\Repository\CombustibleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombustibleRepository::class)]
class Combustible
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
    private ?int $dieselExistencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $dieselCobertura = null;

    #[ORM\Column(nullable: true)]
    private ?int $gasolinaA83Existencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $gasolinaA83Cobertura = null;

    #[ORM\Column(nullable: true)]
    private ?int $gasolinaA90Existencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $gasolinaA90Cobertura = null;

    #[ORM\Column(nullable: true)]
    private ?int $lubricanteGrasaExistencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $lubricanteGrasaCobertura = null;

    #[ORM\Column(nullable: true)]
    private ?int $lubricanteAceiteExistencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $lubricanteAceiteCobertura = null;

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

    public function getDieselExistencia(): ?int
    {
        return $this->dieselExistencia;
    }

    public function setDieselExistencia(?int $dieselExistencia): static
    {
        $this->dieselExistencia = $dieselExistencia;

        return $this;
    }

    public function getDieselCobertura(): ?int
    {
        return $this->dieselCobertura;
    }

    public function setDieselCobertura(?int $dieselCobertura): static
    {
        $this->dieselCobertura = $dieselCobertura;

        return $this;
    }

    public function getGasolinaA83Existencia(): ?int
    {
        return $this->gasolinaA83Existencia;
    }

    public function setGasolinaA83Existencia(?int $gasolinaA83Existencia): static
    {
        $this->gasolinaA83Existencia = $gasolinaA83Existencia;

        return $this;
    }

    public function getGasolinaA83Cobertura(): ?int
    {
        return $this->gasolinaA83Cobertura;
    }

    public function setGasolinaA83Cobertura(?int $gasolinaA83Cobertura): static
    {
        $this->gasolinaA83Cobertura = $gasolinaA83Cobertura;

        return $this;
    }

    public function getGasolinaA90Existencia(): ?int
    {
        return $this->gasolinaA90Existencia;
    }

    public function setGasolinaA90Existencia(?int $gasolinaA90Existencia): static
    {
        $this->gasolinaA90Existencia = $gasolinaA90Existencia;

        return $this;
    }

    public function getGasolinaA90Cobertura(): ?int
    {
        return $this->gasolinaA90Cobertura;
    }

    public function setGasolinaA90Cobertura(?int $gasolinaA90Cobertura): static
    {
        $this->gasolinaA90Cobertura = $gasolinaA90Cobertura;

        return $this;
    }

    public function getLubricanteGrasaExistencia(): ?int
    {
        return $this->lubricanteGrasaExistencia;
    }

    public function setLubricanteGrasaExistencia(?int $lubricanteGrasaExistencia): static
    {
        $this->lubricanteGrasaExistencia = $lubricanteGrasaExistencia;

        return $this;
    }

    public function getLubricanteGrasaCobertura(): ?int
    {
        return $this->lubricanteGrasaCobertura;
    }

    public function setLubricanteGrasaCobertura(?int $lubricanteGrasaCobertura): static
    {
        $this->lubricanteGrasaCobertura = $lubricanteGrasaCobertura;

        return $this;
    }

    public function getLubricanteAceiteExistencia(): ?int
    {
        return $this->lubricanteAceiteExistencia;
    }

    public function setLubricanteAceiteExistencia(?int $lubricanteAceiteExistencia): static
    {
        $this->lubricanteAceiteExistencia = $lubricanteAceiteExistencia;

        return $this;
    }

    public function getLubricanteAceiteCobertura(): ?int
    {
        return $this->lubricanteAceiteCobertura;
    }

    public function setLubricanteAceiteCobertura(?int $lubricanteAceiteCobertura): static
    {
        $this->lubricanteAceiteCobertura = $lubricanteAceiteCobertura;

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
}
