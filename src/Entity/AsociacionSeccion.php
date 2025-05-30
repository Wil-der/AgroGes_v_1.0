<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AsociacionSeccionRepository;

#[ORM\Entity(repositoryClass: AsociacionSeccionRepository::class)]
#[ORM\Table(name: 'asociacion_seccion')]
class AsociacionSeccion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // La sección (nombre como string)
    #[ORM\Column(type: 'string', length: 100)]
    private string $seccion;

    // Relación ManyToOne con Empresa, nullable porque puede ser solo centro
    #[ORM\ManyToOne(targetEntity: Empresa::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Empresa $empresa = null;

    // Relación ManyToOne con UEB (Centro), nullable porque puede ser solo empresa
    #[ORM\ManyToOne(targetEntity: UEB::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?UEB $centro = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeccion(): string
    {
        return $this->seccion;
    }

    public function setSeccion(string $seccion): self
    {
        $this->seccion = $seccion;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getCentro(): ?UEB
    {
        return $this->centro;
    }

    public function setCentro(?UEB $centro): self
    {
        $this->centro = $centro;

        return $this;
    }
}
