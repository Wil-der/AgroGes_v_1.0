<?php

namespace App\Entity;

use App\Repository\CentroPecesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CentroPecesRepository::class)]
class CentroPeces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(nullable: true)]
    private ?int $plan = null;

    #[ORM\Column(nullable: true)]
    private ?int $existanciaDiariaReal = null;

    #[ORM\Column(nullable: true)]
    private ?int $existenciaacumuladaReal = null;

    #[ORM\ManyToOne(inversedBy: 'centros')]
    private ?EntidadPeces $entidadPeces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

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

    public function getEntidadPeces(): ?EntidadPeces
    {
        return $this->entidadPeces;
    }

    public function setEntidadPeces(?EntidadPeces $entidadPeces): static
    {
        $this->entidadPeces = $entidadPeces;

        return $this;
    }
}
