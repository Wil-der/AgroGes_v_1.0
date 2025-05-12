<?php

namespace App\Entity;

use App\Repository\UEBRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UEBRepository::class)]
class UEB
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mision = null;

    #[ORM\Column]
    private ?int $cantTrabajdirecto = null;

    #[ORM\Column]
    private ?int $cantTrabajIndirecto = null;

    #[ORM\Column]
    private ?int $totalTrabaj = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, CentroUEB>
     */
    #[ORM\OneToMany(targetEntity: CentroUEB::class, mappedBy: 'uEB')]
    private Collection $centros;

    #[ORM\ManyToOne(inversedBy: 'ueb')]
    private ?Empresa $empresa = null;

    public function __construct()
    {
        $this->centros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMision(): ?string
    {
        return $this->mision;
    }

    public function setMision(string $mision): static
    {
        $this->mision = $mision;

        return $this;
    }

    public function getCantTrabajdirecto(): ?int
    {
        return $this->cantTrabajdirecto;
    }

    public function setCantTrabajdirecto(int $cantTrabajdirecto): static
    {
        $this->cantTrabajdirecto = $cantTrabajdirecto;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, CentroUEB>
     */
    public function getCentros(): Collection
    {
        return $this->centros;
    }

    public function addCentro(CentroUEB $centro): static
    {
        if (!$this->centros->contains($centro)) {
            $this->centros->add($centro);
            $centro->setUEB($this);
        }

        return $this;
    }

    public function removeCentro(CentroUEB $centro): static
    {
        if ($this->centros->removeElement($centro)) {
            // set the owning side to null (unless already changed)
            if ($centro->getUEB() === $this) {
                $centro->setUEB(null);
            }
        }

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
