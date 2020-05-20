<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrixRepository")
 */
class Prix
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeChambre", mappedBy="prix")
     */
    private $prixChambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $tarif;

    public function __construct()
    {
        $this->prixChambre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|TypeChambre[]
     */
    public function getPrixChambre(): Collection
    {
        return $this->prixChambre;
    }

    public function addPrixChambre(TypeChambre $prixChambre): self
    {
        if (!$this->prixChambre->contains($prixChambre)) {
            $this->prixChambre[] = $prixChambre;
            $prixChambre->setPrix($this);
        }

        return $this;
    }

    public function removePrixChambre(TypeChambre $prixChambre): self
    {
        if ($this->prixChambre->contains($prixChambre)) {
            $this->prixChambre->removeElement($prixChambre);
            // set the owning side to null (unless already changed)
            if ($prixChambre->getPrix() === $this) {
                $prixChambre->setPrix(null);
            }
        }

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }
}
