<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VinsRepository")
 */
class Vins
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Couleurs", inversedBy="vins")
     */
    private $Couleurs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Productor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Appelation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Cepage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Milesime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Region;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Quantite", mappedBy="Vins", cascade={"persist", "remove"})
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cave", inversedBy="Vins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cave;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    public function getImg(): ?self
    {
        return $this->img;
    }

    public function setImg($img): ?self
    {
        $this->img = $img;

        return $this;
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

    public function getCouleurs(): ?Couleurs
    {
        return $this->Couleurs;
    }

    public function setCouleurs(?Couleurs $Couleurs): self
    {
        $this->Couleurs = $Couleurs;

        return $this;
    }

    public function getProductor(): ?string
    {
        return $this->Productor;
    }

    public function setProductor(?string $Productor): self
    {
        $this->Productor = $Productor;

        return $this;
    }

    public function getAppelation(): ?string
    {
        return $this->Appelation;
    }

    public function setAppelation(?string $Appelation): self
    {
        $this->Appelation = $Appelation;

        return $this;
    }

    public function getCepage(): ?string
    {
        return $this->Cepage;
    }

    public function setCepage(?string $Cepage): self
    {
        $this->Cepage = $Cepage;

        return $this;
    }

    public function getMilesime(): ?string
    {
        return $this->Milesime;
    }

    public function setMilesime(?string $Milesime): self
    {
        $this->Milesime = $Milesime;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(?string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getQuantite(): ?Quantite
    {
        return $this->quantite;
    }

    public function setQuantite(?Quantite $quantite): self
    {
        $this->quantite = $quantite;

        // set (or unset) the owning side of the relation if necessary
        $newVins = null === $quantite ? null : $this;
        if ($quantite->getVins() !== $newVins) {
            $quantite->setVins($newVins);
        }

        return $this;
    }

    public function getCave(): ?Cave
    {
        return $this->cave;
    }

    public function setCave(?Cave $cave): self
    {
        $this->cave = $cave;

        return $this;
    }
}
