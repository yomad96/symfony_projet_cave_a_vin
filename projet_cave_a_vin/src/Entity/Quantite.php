<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuantiteRepository")
 */
class Quantite
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
    private $quantity;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vins", inversedBy="quantite", cascade={"persist", "remove"})
     */
    private $Vins;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getVins(): ?Vins
    {
        return $this->Vins;
    }

    public function setVins(?Vins $Vins): self
    {
        $this->Vins = $Vins;

        return $this;
    }
}
