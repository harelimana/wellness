<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Faker\Test\Provider\Collection;

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
     * @ORM\Column(length=45, unique=true)
     */
    private $slug;

    /**
     * @var ArrayCollection
     *  @ORM\OneToMany(targetEntity="Prestataire", mappedBy="service", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $prestataire;


    public function __construct()
    {
        $this->prestataire = new ArrayCollection();
    }

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

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrestataire(): ArrayCollection
    {
        return $this->prestataire;
    }

    /**
     * @param ArrayCollection $prestataires
     */
    public function setPrestataire(ArrayCollection $prestataire): void
    {
        $this->prestataire = $prestataire;
    }


    public function __toString() {
        return $this->Name;
    }
}
