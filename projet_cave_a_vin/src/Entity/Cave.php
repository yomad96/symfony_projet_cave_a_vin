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
    private $Address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vins", mappedBy="cave")
     */
    private $Vins;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cave")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rack", mappedBy="cave")
     */
    private $racks;

    public function __construct()
    {
        $this->Vins = new ArrayCollection();
        $this->racks = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

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

    /**
     * @return Collection|Rack[]
     */
    public function getRacks(): Collection
    {
        return $this->racks;
    }

    public function addRack(Rack $rack): self
    {
        if (!$this->racks->contains($rack)) {
            $this->racks[] = $rack;
            $rack->setCave($this);
        }

        return $this;
    }

    public function removeRack(Rack $rack): self
    {
        if ($this->racks->contains($rack)) {
            $this->racks->removeElement($rack);
            // set the owning side to null (unless already changed)
            if ($rack->getCave() === $this) {
                $rack->setCave(null);
            }
        }

        return $this;
    }
}
