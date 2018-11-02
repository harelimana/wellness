<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CodePostalRepository")
 */
class CodePostal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $CodePostal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="codepostal")
     */
    private $localite;

    public function __construct()
    {
        $this->localite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePostal(): ?int
    {
        return $this->CodePostal;
    }

    public function setCodePostal(int $CodePostal): self
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getLocalite(): Collection
    {
        return $this->localite;
    }

    public function addLocalite(User $localite): self
    {
        if (!$this->localite->contains($localite)) {
            $this->localite[] = $localite;
            $localite->setCodepostal($this);
        }

        return $this;
    }

    public function removeLocalite(User $localite): self
    {
        if ($this->localite->contains($localite)) {
            $this->localite->removeElement($localite);
            // set the owning side to null (unless already changed)
            if ($localite->getCodepostal() === $this) {
                $localite->setCodepostal(null);
            }
        }

        return $this;
    }
}
