<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 */
class Stage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $affichageDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $affichageFin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debutStage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $finStage;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $moreInfo;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $tarif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataire", inversedBy="stages")
     * @ORM\JoinColumn(nullable=true)
     */
    private $prestataires;


    public function __construct()
    {
        $this->debutStage = new \DateTime();
        $this->finStage = new \DateTime();
        $this->affichageDebut = new \DateTime();
        $this->affichageFin = new \DateTime();
        $this->prestataire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAffichageDebut(): ?\DateTimeInterface
    {
        return $this->affichageDebut;
    }

    public function setAffichageDebut(\DateTimeInterface $affichageDebut): self
    {
        $this->affichageDebut = $affichageDebut;

        return $this;
    }

    public function getAffichageFin(): ?\DateTimeInterface
    {
        return $this->affichageFin;
    }

    public function setAffichageFin(\DateTimeInterface $affichageFin): self
    {
        $this->affichageFin = $affichageFin;

        return $this;
    }

    public function getDebutStage(): ?\DateTimeInterface
    {
        return $this->debutStage;
    }

    public function setDebutstage(\DateTimeInterface $debutStage): self
    {
        $this->debutStage = $debutStage;

        return $this;
    }

    public function getFinStage(): ?\DateTimeInterface
    {
        return $this->finStage;
    }

    public function setFinStage(\DateTimeInterface $finStage): self
    {
        $this->finStage = $finStage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMoreInfo(): ?string
    {
        return $this->moreInfo;
    }

    public function setMoreInfo(?string $moreInfo): self
    {
        $this->moreInfo = $moreInfo;

        return $this;
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

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrestataire(): ArrayCollection
    {
        return $this->prestataires;
    }

    /**
     * @param mixed $prestataires
     */
    public function setPrestataires($prestataires): void
    {
        $this->prestataires = $prestataires;
    }

    /**
     * @param Prestataire $prestataire
     * @return Stage
     */
    public function addPrestataire(Prestataire $prestataire): self
    {
        if(!$this->prestataire->contains($prestataire)){
            $this->prestataires[] = $prestataire;
            $prestataire->addStage($this);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

}
