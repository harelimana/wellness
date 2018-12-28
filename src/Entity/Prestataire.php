<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="prestataires")
     * @ORM\JoinColumn(nullable=true)
     */
    private $stages;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", inversedBy="prestataires")
     * @ORM\JoinColumn(name="service_id",referencedColumnName="id", nullable=true)
     */
    private $services;

    /**
     * Prestataire constructor.
     */
    public function __construct()
    {
        $this->services = new ArrayCollection();
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
    public function getStages(): Collection
    {
        return $this->stages;
    }


    /**
     * @return ArrayCollection
     */
    public function getService(): ArrayCollection
    {
        return $this->services;
    }

    /**
     * @param Stage $stage
     * @return Stage|ArrayCollection
     */
    public function addStage(Stage $stage): ArrayCollection
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setPrestataires($this);

        }
        return $this->stages[] = $stage;
    }

    /**
     * @param Stage $stage
     */
    public function removeStage(Stage $stage)
    {
        $this->stages->removeElement($stage);
    }

    /**
     * @param Service $service
     * @return Service|ArrayCollection
     */
    public function addService(Service $service)
    {
        return $this->services[] = $service;
    }

    /**
     * @param Service $service
     */
    public function removeService(Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * @return ArrayCollection
     */
    public function getServices(): ArrayCollection
    {
        return $this->services;
    }

    /**
     * @param ArrayCollection $services
     */
    public function setServices(ArrayCollection $services): void
    {
        $this->services = $services;
    }


    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }
}
