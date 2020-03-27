<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RackRepository")
 */
class Rack
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
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $ligneTotal;

    /**
     * @ORM\Column(type="integer")
     */
    private $colonneTotal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cave", inversedBy="racks")
     */
    private $cave;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLigneTotal(): ?int
    {
        return $this->ligneTotal;
    }

    public function setLigneTotal(int $ligneTotal): self
    {
        $this->ligneTotal = $ligneTotal;

        return $this;
    }

    public function getColonneTotal(): ?int
    {
        return $this->colonneTotal;
    }

    public function setColonneTotal(int $colonneTotal): self
    {
        $this->colonneTotal = $colonneTotal;

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
