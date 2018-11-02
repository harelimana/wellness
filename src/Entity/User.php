<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\MakerBundle\Doctrine;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"internaute" = "Internaute", "prestataire" = "Prestataire"})
 *
 */
Abstract class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $addressNumber;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $addressRue;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $banni;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inscription;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $inscriptionDate;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $successAttempt;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodePostal", inversedBy="localite")
     * @ORM\JoinColumn(nullable=false)
     */
    private $codepostal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localite")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commune")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commune;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Prestataire", mappedBy="user", cascade={"persist", "remove"})
     */
    private $prestataire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressNumber(): ?string
    {
        return $this->addressNumber;
    }

    public function setAddressNumber(string $addressNumber): self
    {
        $this->addressNumber = $addressNumber;

        return $this;
    }

    public function getAddressRue(): ?string
    {
        return $this->addressRue;
    }

    public function setAddressRue(string $addressRue): self
    {
        $this->addressRue = $addressRue;

        return $this;
    }

    public function getBanni(): ?bool
    {
        return $this->banni;
    }

    public function setBanni(bool $banni): self
    {
        $this->banni = $banni;

        return $this;
    }


    public function getInscription(): ?bool
    {
        return $this->inscription;
    }

    public function setInscription(bool $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getInscriptionDate(): ?\DateTimeInterface
    {
        return $this->inscriptionDate;
    }

    public function setInscriptionDate(?\DateTimeInterface $inscriptionDate): self
    {
        $this->inscriptionDate = $inscriptionDate;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSuccessAttempt(): ?int
    {
        return $this->successAttempt;
    }

    public function setSuccessAttempt(?int $successAttempt): self
    {
        $this->successAttempt = $successAttempt;

        return $this;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): self
    {
        $this->userType = $userType;

        return $this;
    }

    public function getCodepostal(): ?CodePostal
    {
        return $this->codepostal;
    }

    public function setCodepostal(?CodePostal $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getLocalite(): ?Localite
    {
        return $this->localite;
    }

    public function setLocalite(?Localite $localite): self
    {
        $this->localite = $localite;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        // set the owning side of the relation if necessary
        if ($this !== $prestataire->getUser()) {
            $prestataire->setUser($this);
        }

        return $this;
    }
}
