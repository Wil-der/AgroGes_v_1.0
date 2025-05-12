<?php

namespace App\Entity;

use App\Repository\ParteGeneralRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParteGeneralRepository::class)]
class ParteGeneral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    /**
     * @var Collection<int, ParteDiario>
     */
    #[ORM\OneToMany(targetEntity: ParteDiario::class, mappedBy: 'parteGeneral')]
    private Collection $parteDiario;

    #[ORM\ManyToOne(inversedBy: 'parteGeneral')]
    private ?Osde $osde = null;

    public function __construct()
    {
        $this->parteDiario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return Collection<int, ParteDiario>
     */
    public function getParteDiario(): Collection
    {
        return $this->parteDiario;
    }

    public function addParteDiario(ParteDiario $parteDiario): static
    {
        if (!$this->parteDiario->contains($parteDiario)) {
            $this->parteDiario->add($parteDiario);
            $parteDiario->setParteGeneral($this);
        }

        return $this;
    }

    public function removeParteDiario(ParteDiario $parteDiario): static
    {
        if ($this->parteDiario->removeElement($parteDiario)) {
            // set the owning side to null (unless already changed)
            if ($parteDiario->getParteGeneral() === $this) {
                $parteDiario->setParteGeneral(null);
            }
        }

        return $this;
    }

    public function getOsde(): ?Osde
    {
        return $this->osde;
    }

    public function setOsde(?Osde $osde): static
    {
        $this->osde = $osde;

        return $this;
    }
}
