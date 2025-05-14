<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, ParteDiario>
     */
    #[ORM\OneToMany(targetEntity: ParteDiario::class, mappedBy: 'empresa')]
    private Collection $parteDiario;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'empresa')]
    private Collection $users;

    #[ORM\Column]
    private ?int $cantTrabajDirecto = null;

    #[ORM\Column]
    private ?int $cantTrabajIndirecto = null;

    #[ORM\Column]
    private ?int $totalTrabaj = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mision = null;

    /**
     * @var Collection<int, UEB>
     */
    #[ORM\OneToMany(targetEntity: UEB::class, mappedBy: 'empresa')]
    private Collection $ueb;

    /**
     * @var Collection<int, PlantillaTrabajEmpresa>
     */
    #[ORM\OneToMany(targetEntity: PlantillaTrabajEmpresa::class, mappedBy: 'empresa')]
    private Collection $plantillaTrabaj;

    /**
     * @var Collection<int, GuiaTelefonicaEmpresa>
     */
    #[ORM\OneToMany(targetEntity: GuiaTelefonicaEmpresa::class, mappedBy: 'empresa')]
    private Collection $guiaTelefonica;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?EstructuraOrganizativaEmpresa $estructuraOrganizativa = null;

   
    public function __construct()
    {
        $this->parteDiario = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->ueb = new ArrayCollection();
        $this->plantillaTrabaj = new ArrayCollection();
        $this->guiaTelefonica = new ArrayCollection();
    }

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
            $parteDiario->setEmpresa($this);
        }

        return $this;
    }

    public function removeParteDiario(ParteDiario $parteDiario): static
    {
        if ($this->parteDiario->removeElement($parteDiario)) {
            // set the owning side to null (unless already changed)
            if ($parteDiario->getEmpresa() === $this) {
                $parteDiario->setEmpresa(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setEmpresa($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getEmpresa() === $this) {
                $user->setEmpresa(null);
            }
        }

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

    public function getMision(): ?string
    {
        return $this->mision;
    }

    public function setMision(string $mision): static
    {
        $this->mision = $mision;

        return $this;
    }

    /**
     * @return Collection<int, UEB>
     */
    public function getUeb(): Collection
    {
        return $this->ueb;
    }

    public function addUeb(UEB $ueb): static
    {
        if (!$this->ueb->contains($ueb)) {
            $this->ueb->add($ueb);
            $ueb->setEmpresa($this);
        }

        return $this;
    }

    public function removeUeb(UEB $ueb): static
    {
        if ($this->ueb->removeElement($ueb)) {
            // set the owning side to null (unless already changed)
            if ($ueb->getEmpresa() === $this) {
                $ueb->setEmpresa(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlantillaTrabajEmpresa>
     */
    public function getPlantillaTrabaj(): Collection
    {
        return $this->plantillaTrabaj;
    }

    public function addPlantillaTrabaj(PlantillaTrabajEmpresa $plantillaTrabaj): static
    {
        if (!$this->plantillaTrabaj->contains($plantillaTrabaj)) {
            $this->plantillaTrabaj->add($plantillaTrabaj);
            $plantillaTrabaj->setEmpresa($this);
        }

        return $this;
    }

    public function removePlantillaTrabaj(PlantillaTrabajEmpresa $plantillaTrabaj): static
    {
        if ($this->plantillaTrabaj->removeElement($plantillaTrabaj)) {
            // set the owning side to null (unless already changed)
            if ($plantillaTrabaj->getEmpresa() === $this) {
                $plantillaTrabaj->setEmpresa(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GuiaTelefonicaEmpresa>
     */
    public function getGuiaTelefonica(): Collection
    {
        return $this->guiaTelefonica;
    }

    public function addGuiaTelefonica(GuiaTelefonicaEmpresa $guiaTelefonica): static
    {
        if (!$this->guiaTelefonica->contains($guiaTelefonica)) {
            $this->guiaTelefonica->add($guiaTelefonica);
            $guiaTelefonica->setEmpresa($this);
        }

        return $this;
    }

    public function removeGuiaTelefonica(GuiaTelefonicaEmpresa $guiaTelefonica): static
    {
        if ($this->guiaTelefonica->removeElement($guiaTelefonica)) {
            // set the owning side to null (unless already changed)
            if ($guiaTelefonica->getEmpresa() === $this) {
                $guiaTelefonica->setEmpresa(null);
            }
        }

        return $this;
    }

    public function getEstructuraOrganizativa(): ?EstructuraOrganizativaEmpresa
    {
        return $this->estructuraOrganizativa;
    }

    public function setEstructuraOrganizativa(?EstructuraOrganizativaEmpresa $estructuraOrganizativa): static
    {
        $this->estructuraOrganizativa = $estructuraOrganizativa;

        return $this;
    }

}
