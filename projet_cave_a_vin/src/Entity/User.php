<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifiant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cave", mappedBy="user")
     */
    private $Cave;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    public function __construct()
    {
        $this->Cave = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    /**
     * @return Collection|Cave[]
     */
    public function getCave(): Collection
    {
        return $this->Cave;
    }

    public function addCave(Cave $cave): self
    {
        if (!$this->Cave->contains($cave)) {
            $this->Cave[] = $cave;
            $cave->setUser($this);
        }

        return $this;
    }

    public function removeCave(Cave $cave): self
    {
        if ($this->Cave->contains($cave)) {
            $this->Cave->removeElement($cave);
            // set the owning side to null (unless already changed)
            if ($cave->getUser() === $this) {
                $cave->setUser(null);
            }
        }

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }
}
