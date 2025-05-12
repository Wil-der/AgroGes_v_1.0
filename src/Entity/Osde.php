<?php

namespace App\Entity;

use App\Repository\OsdeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OsdeRepository::class)]
class Osde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mision = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $vision = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $address = null;

    /**
     * @var Collection<int, ParteGeneral>
     */
    #[ORM\OneToMany(targetEntity: ParteGeneral::class, mappedBy: 'osde')]
    private Collection $parteGeneral;

    /**
     * @var Collection<int, GuiaTelefonica>
     */
    #[ORM\OneToMany(targetEntity: GuiaTelefonica::class, mappedBy: 'osde')]
    private Collection $guiaTelefonica;

    /**
     * @var Collection<int, EstructuraOrganizativa>
     */
    #[ORM\OneToMany(targetEntity: EstructuraOrganizativa::class, mappedBy: 'osde')]
    private Collection $estructuraOrganizativa;

    public function __construct()
    {
        $this->parteGeneral = new ArrayCollection();
        $this->guiaTelefonica = new ArrayCollection();
        $this->estructuraOrganizativa = new ArrayCollection();
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

    public function getVision(): ?string
    {
        return $this->vision;
    }

    public function setVision(string $vision): static
    {
        $this->vision = $vision;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, ParteGeneral>
     */
    public function getParteGeneral(): Collection
    {
        return $this->parteGeneral;
    }

    public function addParteGeneral(ParteGeneral $parteGeneral): static
    {
        if (!$this->parteGeneral->contains($parteGeneral)) {
            $this->parteGeneral->add($parteGeneral);
            $parteGeneral->setOsde($this);
        }

        return $this;
    }

    public function removeParteGeneral(ParteGeneral $parteGeneral): static
    {
        if ($this->parteGeneral->removeElement($parteGeneral)) {
            // set the owning side to null (unless already changed)
            if ($parteGeneral->getOsde() === $this) {
                $parteGeneral->setOsde(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GuiaTelefonica>
     */
    public function getGuiaTelefonica(): Collection
    {
        return $this->guiaTelefonica;
    }

    public function addGuiaTelefonica(GuiaTelefonica $guiaTelefonica): static
    {
        if (!$this->guiaTelefonica->contains($guiaTelefonica)) {
            $this->guiaTelefonica->add($guiaTelefonica);
            $guiaTelefonica->setOsde($this);
        }

        return $this;
    }

    public function removeGuiaTelefonica(GuiaTelefonica $guiaTelefonica): static
    {
        if ($this->guiaTelefonica->removeElement($guiaTelefonica)) {
            // set the owning side to null (unless already changed)
            if ($guiaTelefonica->getOsde() === $this) {
                $guiaTelefonica->setOsde(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EstructuraOrganizativa>
     */
    public function getEstructuraOrganizativa(): Collection
    {
        return $this->estructuraOrganizativa;
    }

    public function addEstructuraOrganizativa(EstructuraOrganizativa $estructuraOrganizativa): static
    {
        if (!$this->estructuraOrganizativa->contains($estructuraOrganizativa)) {
            $this->estructuraOrganizativa->add($estructuraOrganizativa);
            $estructuraOrganizativa->setOsde($this);
        }

        return $this;
    }

    public function removeEstructuraOrganizativa(EstructuraOrganizativa $estructuraOrganizativa): static
    {
        if ($this->estructuraOrganizativa->removeElement($estructuraOrganizativa)) {
            // set the owning side to null (unless already changed)
            if ($estructuraOrganizativa->getOsde() === $this) {
                $estructuraOrganizativa->setOsde(null);
            }
        }

        return $this;
    }
}
