<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmplacementRepository")
 */
class Emplacement
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
    private $ligne;

    /**
     * @ORM\Column(type="integer")
     */
    private $colonne;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vins", inversedBy="emplacement", cascade={"persist", "remove"})
     */
    private $vin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLigne(): ?int
    {
        return $this->ligne;
    }

    public function setLigne(int $ligne): self
    {
        $this->ligne = $ligne;

        return $this;
    }

    public function getColonne(): ?int
    {
        return $this->colonne;
    }

    public function setColonne(int $colonne): self
    {
        $this->colonne = $colonne;

        return $this;
    }

    public function getVin(): ?Vins
    {
        return $this->vin;
    }

    public function setVin(?Vins $vin): self
    {
        $this->vin = $vin;

        return $this;
    }
}
