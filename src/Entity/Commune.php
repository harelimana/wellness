<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommuneRepository")
 */
class Commune
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="commune", type="string", length=64, unique=true)
     */
    private $commune;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="commune")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function isDuplicate($commune)
    {
        if (!$this->setCommune($commune) || (!null)) {
            return $this->commune = $this->setCommune($commune);
        }
    }

    public function __toString()
    {
        return $this->getCommune();
    }
}
