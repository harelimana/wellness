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
     * @ORM\ManyToMany(targetEntity="Prestataire", mappedBy="services", cascade={"persist"})
     * @ORM\JoinColumn(name="prestataire_id",referencedColumnName="id",nullable=true)
     */
     private $prestataires;


    public function __construct()
    {
        $this->prestataires = new ArrayCollection();
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
     * @return Prestataire[]|ArrayCollection|Collection
     */
    public function getPrestataire()
    {
        return $this->prestataires;
    }

    /**
     * @param Prestataire $prestataire
     * @return Prestataire
     */
    public function addPrestataire(Prestataire $prestataire){
        return $this->prestataires[] = $prestataire;
    }

    /**
     * @param Prestataire $prestataire
     */
    public function removePrestataire(Prestataire $prestataire){
        $this->prestataires->removeElement($prestataire);
    }

    public function searchBySlug($slug){
        return $service = $this->$em->getDoctrine()
            ->getRepository(Service::class)
            ->findBySlug();
    }

    /**
     * @return mixed
     */
    public function servicesByPrestataire()
    {
        return $this->services = $this->getRepository()->servicesbyPrestataire();
    }

    /**
     * @return mixed
     */
    public function __toString() {
        return $this->Name;
    }
}
