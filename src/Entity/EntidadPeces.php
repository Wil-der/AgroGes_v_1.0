<?php

namespace App\Entity;

use App\Repository\EntidadPecesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntidadPecesRepository::class)]
class EntidadPeces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, CentroPeces>
     */
    #[ORM\OneToMany(targetEntity: CentroPeces::class, mappedBy: 'entidadPeces')]
    private Collection $centros;

    #[ORM\ManyToOne(inversedBy: 'entidades')]
    private ?Peces $peces = null;

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
     * @return Collection<int, CentroPeces>
     */
    public function getCentros(): Collection
    {
        return $this->centros;
    }

    public function addCentro(CentroPeces $centro): static
    {
        if (!$this->centros->contains($centro)) {
            $this->centros->add($centro);
            $centro->setEntidadPeces($this);
        }

        return $this;
    }

    public function removeCentro(CentroPeces $centro): static
    {
        if ($this->centros->removeElement($centro)) {
            // set the owning side to null (unless already changed)
            if ($centro->getEntidadPeces() === $this) {
                $centro->setEntidadPeces(null);
            }
        }

        return $this;
    }

    public function getPeces(): ?Peces
    {
        return $this->peces;
    }

    public function setPeces(?Peces $peces): static
    {
        $this->peces = $peces;

        return $this;
    }
}
