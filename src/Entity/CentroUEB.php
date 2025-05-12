<?php

namespace App\Entity;

use App\Repository\CentroUEBRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CentroUEBRepository::class)]
class CentroUEB
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $cantTrabajDirecto = null;

    #[ORM\Column]
    private ?int $cantTrabajIndirecto = null;

    #[ORM\Column]
    private ?int $totalTrabaj = null;

    #[ORM\ManyToOne(inversedBy: 'centros')]
    private ?UEB $uEB = null;

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

    public function getCantTrabajDirecto(): ?int
    {
        return $this->cantTrabajDirecto;
    }

    public function setCantTrabajDirecto(int $cantTrabajDirecto): static
    {
        $this->cantTrabajDirecto = $cantTrabajDirecto;

        return $this;
    }

    public function getCantTrabajIndirecto(): ?int
    {
        return $this->cantTrabajIndirecto;
    }

    public function setCantTrabajIndirecto(int $cantTrabajIndirecto): static
    {
        $this->cantTrabajIndirecto = $cantTrabajIndirecto;

        return $this;
    }

    public function getTotalTrabaj(): ?int
    {
        return $this->totalTrabaj;
    }

    public function setTotalTrabaj(int $totalTrabaj): static
    {
        $this->totalTrabaj = $totalTrabaj;

        return $this;
    }

    public function getUEB(): ?UEB
    {
        return $this->uEB;
    }

    public function setUEB(?UEB $uEB): static
    {
        $this->uEB = $uEB;

        return $this;
    }
}
