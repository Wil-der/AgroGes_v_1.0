<?php

namespace App\Entity;

use App\Repository\PecesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PecesRepository::class)]
class Peces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    /**
     * @var Collection<int, EntidadPeces>
     */
    #[ORM\OneToMany(targetEntity: EntidadPeces::class, mappedBy: 'peces')]
    private Collection $entidades;

    #[ORM\Column(nullable: true)]
    private ?array $total = null;

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
     * @return Collection<int, EntidadPeces>
     */
    public function getEntidades(): Collection
    {
        return $this->entidades;
    }

    public function addEntidade(EntidadPeces $entidade): static
    {
        if (!$this->entidades->contains($entidade)) {
            $this->entidades->add($entidade);
            $entidade->setPeces($this);
        }

        return $this;
    }

    public function removeEntidade(EntidadPeces $entidade): static
    {
        if ($this->entidades->removeElement($entidade)) {
            // set the owning side to null (unless already changed)
            if ($entidade->getPeces() === $this) {
                $entidade->setPeces(null);
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
}
