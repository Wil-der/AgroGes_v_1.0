<?php

namespace App\Entity;

use App\Repository\ProduccionHuevosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduccionHuevosRepository::class)]
class ProduccionHuevos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    /**
     * @var Collection<int, Entidad>
     */
    #[ORM\OneToMany(targetEntity: Entidad::class, mappedBy: 'produccionHuevos')]
    private Collection $entidades;

    public function __construct()
    {
        $this->entidades = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Entidad>
     */
    public function getEntidades(): Collection
    {
        return $this->entidades;
    }

    public function addEntidade(Entidad $entidade): static
    {
        if (!$this->entidades->contains($entidade)) {
            $this->entidades->add($entidade);
            $entidade->setProduccionHuevos($this);
        }

        return $this;
    }

    public function removeEntidade(Entidad $entidade): static
    {
        if ($this->entidades->removeElement($entidade)) {
            // set the owning side to null (unless already changed)
            if ($entidade->getProduccionHuevos() === $this) {
                $entidade->setProduccionHuevos(null);
            }
        }

        return $this;
    }
}
