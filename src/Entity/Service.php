<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $Name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $EnAvant;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Valide;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $Description;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     */
    private $Image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataire", inversedBy="service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestataire;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEnAvant(): ?bool
    {
        return $this->EnAvant;
    }

    public function setEnAvant(bool $EnAvant): self
    {
        $this->EnAvant = $EnAvant;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->Valide;
    }

    public function setValide(bool $Valide): self
    {
        $this->Valide = $Valide;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->Image;
    }

    public function setImage(?Image $Image): self
    {
        $this->Image = $Image;

        return $this;
    }
    public function __toString() {
        return $this->name;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }
}
