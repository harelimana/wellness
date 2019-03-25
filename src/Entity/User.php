<?php

namespace App\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\MakerBundle\Doctrine;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="userType", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "internaute" = "Internaute", "prestataire" = "Prestataire"})
 * @UniqueEntity(fields = {"email"}, message = "This email is already in use !")
 *
 */
Abstract class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    protected $username;

    /**
     * @ORM\Column(type="string", length=16)
     */
    protected $addressNumber;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $addressRue;

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\NotBlank(message = "Blank email is not allowed !")
     * @Assert\Email(message = "This email is invalid !")
     */
    protected $email;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $banni;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $inscription;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $inscriptionDate;

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\Length(min = "8", minMessage="votre password doit avoir min 8 chars")
     * @Assert\EqualTo(propertyPath = "confirmPassword", message = "votre password doit être le même partout !")
     * @Assert\NotBlank(message = "Blank password is not allowed !")
     *
     */
    protected $password;


    /**
     * @var
     * @Assert\EqualTo(propertyPath= "password")
     */
    protected $confirmPassword;

    /**
     * @var
     * @Assert\EqualTo(propertyPath = "password", message = "votre password doit être le même partout !")
     */
    protected $resetPassword;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $successAttempt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodePostal", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $codepostal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localite", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $localite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commune", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $commune;

    /**
     * @ORM\Column(type="string", length=45, nullable=true, unique=true)
     */
    protected $token;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }


    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword($confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }

    /**
     * @return mixed
     */
    public function getResetPassword()
    {
        return $this->resetPassword;
    }

    /**
     * @param mixed $resetPassword
     */
    public function setResetPassword($resetPassword): void
    {
        $this->resetPassword = $resetPassword;
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

    public function eraseCredentials(){

    }
    public function getSalt(){

    }
    public function getRoles() {
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER,ROLE_PRESTATAIRE,ROLE_ADMIN';
        return $roles;
    }

    public function setRoles(array $roles) {
        return $this->roles = $roles;
    }

    /**
     * @param EntityManager $em
     * @return mixed
     */
    public function lastHiredPrestataire(EntityManager $em )
    {
       return $presta = $this->$em->getDoctrine()
            ->getRepository(User::class)
            ->lastHiredPrestataire();
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function serviceByPrestataire($id)
    {
       return $this->getDoctrine()->getRepository(User::class)->findServiceByPrestataire($id);
        //    ->findOneBy($id);
    }

    /**
     * @return bool|string
     */
    public function getClass()
    {
        return substr(strrchr(__CLASS__, "\\"), 1);
    }
}
