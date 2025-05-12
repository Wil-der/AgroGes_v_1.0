<?php

namespace App\Entity;

use App\Repository\EntidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntidadRepository::class)]
class Entidad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Centro>
     */
    #[ORM\OneToMany(targetEntity: Centro::class, mappedBy: 'entidad')]
    private Collection $centros;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $total = null;

    #[ORM\ManyToOne(inversedBy: 'entidades')]
    private ?ProduccionHuevos $produccionHuevos = null;

    public function __construct()
    {
        $this->centros = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Centro>
     */
    public function getCentros(): Collection
    {
        return $this->centros;
    }

    public function addCentro(Centro $centro): static
    {
        if (!$this->centros->contains($centro)) {
            $this->centros->add($centro);
            $centro->setEntidad($this);
        }

        return $this;
    }

    public function removeCentro(Centro $centro): static
    {
        if ($this->centros->removeElement($centro)) {
            // set the owning side to null (unless already changed)
            if ($centro->getEntidad() === $this) {
                $centro->setEntidad(null);
            }
        }

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

    public function getProduccionHuevos(): ?ProduccionHuevos
    {
        return $this->produccionHuevos;
    }

    public function setProduccionHuevos(?ProduccionHuevos $produccionHuevos): static
    {
        $this->produccionHuevos = $produccionHuevos;

        return $this;
    }
}
