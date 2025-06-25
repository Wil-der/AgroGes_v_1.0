<?php

namespace App\Entity;

use App\Repository\ParteDiarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParteDiarioRepository::class)]
class ParteDiario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Contenedores $contenedores = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Campana1 $campana1 = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Campana2 $campana2 = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Combustible $combustible = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?EquipoRiego $equipoRiego = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ExtraccionCombustible $extraccionCombustible = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?HechosExtraordinarios $hechosExtraordinarios = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MaquinaIngeniera $maquinaIngeniera = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Mortalidad $mortalidad = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Nacimientos $nacimientos = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Peces $peces = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Pienso $pienso = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ProduccionHuevos $produccionHuevos = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Transportacion $transportacion = null;

    #[ORM\ManyToOne(inversedBy: 'parteDiario')]
    private ?ParteGeneral $parteGeneral = null;

    #[ORM\ManyToOne(inversedBy: 'parteDiario')]
    private ?Empresa $empresa = null;

    #[ORM\Column]
    private ?bool $completo = null;

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

    public function getContenedores(): ?Contenedores
    {
        return $this->contenedores;
    }

    public function setContenedores(?Contenedores $contenedores): static
    {
        $this->contenedores = $contenedores;

        return $this;
    }

    public function getCampana1(): ?Campana1
    {
        return $this->campana1;
    }

    public function setCampana1(?Campana1 $campana1): static
    {
        $this->campana1 = $campana1;

        return $this;
    }

    public function getCampana2(): ?Campana2
    {
        return $this->campana2;
    }

    public function setCampana2(?Campana2 $campana2): static
    {
        $this->campana2 = $campana2;

        return $this;
    }

    public function getCombustible(): ?Combustible
    {
        return $this->combustible;
    }

    public function setCombustible(?Combustible $combustible): static
    {
        $this->combustible = $combustible;

        return $this;
    }

    public function getEquipoRiego(): ?EquipoRiego
    {
        return $this->equipoRiego;
    }

    public function setEquipoRiego(?EquipoRiego $equipoRiego): static
    {
        $this->equipoRiego = $equipoRiego;

        return $this;
    }

    public function getExtraccionCombustible(): ?ExtraccionCombustible
    {
        return $this->extraccionCombustible;
    }

    public function setExtraccionCombustible(?ExtraccionCombustible $extraccionCombustible): static
    {
        $this->extraccionCombustible = $extraccionCombustible;

        return $this;
    }

    public function getHechosExtraordinarios(): ?HechosExtraordinarios
    {
        return $this->hechosExtraordinarios;
    }

    public function setHechosExtraordinarios(?HechosExtraordinarios $hechosExtraordinarios): static
    {
        $this->hechosExtraordinarios = $hechosExtraordinarios;

        return $this;
    }

    public function getMaquinaIngeniera(): ?MaquinaIngeniera
    {
        return $this->maquinaIngeniera;
    }

    public function setMaquinaIngeniera(?MaquinaIngeniera $maquinaIngeniera): static
    {
        $this->maquinaIngeniera = $maquinaIngeniera;

        return $this;
    }

    public function getMortalidad(): ?Mortalidad
    {
        return $this->mortalidad;
    }

    public function setMortalidad(?Mortalidad $mortalidad): static
    {
        $this->mortalidad = $mortalidad;

        return $this;
    }

    public function getNacimientos(): ?Nacimientos
    {
        return $this->nacimientos;
    }

    public function setNacimientos(?Nacimientos $nacimientos): static
    {
        $this->nacimientos = $nacimientos;

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

    public function getPienso(): ?Pienso
    {
        return $this->pienso;
    }

    public function setPienso(?Pienso $pienso): static
    {
        $this->pienso = $pienso;

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

    public function getTransportacion(): ?Transportacion
    {
        return $this->transportacion;
    }

    public function setTransportacion(?Transportacion $transportacion): static
    {
        $this->transportacion = $transportacion;

        return $this;
    }

    public function getParteGeneral(): ?ParteGeneral
    {
        return $this->parteGeneral;
    }

    public function setParteGeneral(?ParteGeneral $parteGeneral): static
    {
        $this->parteGeneral = $parteGeneral;

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

    public function isCompleto(): ?bool
    {
        return $this->completo;
    }

    public function setCompleto(bool $completo): static
    {
        $this->completo = $completo;

        return $this;
    }
}
