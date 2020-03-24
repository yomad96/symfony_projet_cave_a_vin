<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouleursRepository")
 */
class Couleurs
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vins", mappedBy="Couleurs")
     */
    private $vins;

    public function __construct()
    {
        $this->vins = new ArrayCollection();
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

    /**
     * @return Collection|Vins[]
     */
    public function getVins(): Collection
    {
        return $this->vins;
    }

    public function addVin(Vins $vin): self
    {
        if (!$this->vins->contains($vin)) {
            $this->vins[] = $vin;
            $vin->setCouleurs($this);
        }

        return $this;
    }

    public function removeVin(Vins $vin): self
    {
        if ($this->vins->contains($vin)) {
            $this->vins->removeElement($vin);
            // set the owning side to null (unless already changed)
            if ($vin->getCouleurs() === $this) {
                $vin->setCouleurs(null);
            }
        }

        return $this;
    }
}
