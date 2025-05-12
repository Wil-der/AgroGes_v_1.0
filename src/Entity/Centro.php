<?php

namespace App\Entity;

use App\Repository\CentroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CentroRepository::class)]
class Centro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?CentroHuevos $centroHuevos = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?CentroPeces $centroPeces = null;

    #[ORM\ManyToOne(inversedBy: 'centros')]
    private ?Empresa $empresa = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCentroHuevos(): ?CentroHuevos
    {
        return $this->centroHuevos;
    }

    public function setCentroHuevos(?CentroHuevos $centroHuevos): static
    {
        $this->centroHuevos = $centroHuevos;

        return $this;
    }

    public function getCentroPeces(): ?CentroPeces
    {
        return $this->centroPeces;
    }

    public function setCentroPeces(?CentroPeces $centroPeces): static
    {
        $this->centroPeces = $centroPeces;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): static
    {
        $this->empresa = $empresa;

        return $this;
    }
}
