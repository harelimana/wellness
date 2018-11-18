<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestataireRepository")
 */
class Prestataire extends User
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
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $telnumber;

    /**
     * @ORM\Column(type="string")
     */
    private $tvanumber;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $website;

    /**
     * @ORM\Column(length=45, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="prestataire")
     */
    private $stages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", inversedBy="prestataire")
     */
    private $services;

    public function __construct()
    {
      //  $this->services = new ArrayCollection();
        $this->stages = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTelnumber(): ?string
    {
        return $this->telnumber;
    }

    public function setTelnumber(?string $telnumber): self
    {
        $this->telnumber = $telnumber;

        return $this;
    }

    public function getTvanumber(): ?string
    {
        return $this->tvanumber;
    }

    public function setTvanumber(string $tvanumber): self
    {
        $this->tvanumber = $tvanumber;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLogo(): ?Image
    {
        return $this->logo;
    }

    public function setLogo(Image $logo): self
    {
        $this->logo = $logo;

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
     * @return Collection|Stage[]
     */
    public function getStage(): Collection
    {
        return $this->stages;
    }

    /**
     * @param Stage $stage
     * @return Prestataire
     */
    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setPrestataire($this);
        }

        return $this;
    }

    /**
     * @param Stage $stage
     * @return Prestataire
     */

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            if ($stage->getPrestataire() === $this) {
                $stage->setPrestataire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getService(): Collection
    {
        return $this->services;
    }
/*
    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addPrestataire($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            // set the owning side to null (unless already changed)
            if ($services->getPrestataire() === $this) {
                $services->setPrestataire(null);
            }
        }

        return $this;
    }
*/

    public function __toString()
    {
        return $this->name;
    }
}
