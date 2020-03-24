<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaveRepository")
 */
class Cave
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vins", mappedBy="cave")
     */
    private $Vins;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Cave")
     */
    private $user;

    public function __construct()
    {
        $this->Vins = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    /**
     * @return Collection|Vins[]
     */
    public function getVins(): Collection
    {
        return $this->Vins;
    }

    public function addVin(Vins $vin): self
    {
        if (!$this->Vins->contains($vin)) {
            $this->Vins[] = $vin;
            $vin->setCave($this);
        }

        return $this;
    }

    public function removeVin(Vins $vin): self
    {
        if ($this->Vins->contains($vin)) {
            $this->Vins->removeElement($vin);
            // set the owning side to null (unless already changed)
            if ($vin->getCave() === $this) {
                $vin->setCave(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
