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
