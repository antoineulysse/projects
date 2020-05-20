<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
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
    private $NomHotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreEtoile;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroTelephone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chambre", mappedBy="hotel", orphanRemoval=true)
     */
    private $chambre;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CaracteristiqueHotel", mappedBy="hotel")
     */
    private $caracteristiqueHotels;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", inversedBy="hotels")
     */
    private $adresse;

    public function __construct()
    {
        $this->chambre = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->caracteristiqueHotels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomHotel(): ?string
    {
        return $this->NomHotel;
    }

    public function setNomHotel(string $NomHotel): self
    {
        $this->NomHotel = $NomHotel;

        return $this;
    }

    public function getNombreEtoile(): ?string
    {
        return $this->nombreEtoile;
    }

    public function setNombreEtoile(string $nombreEtoile): self
    {
        $this->nombreEtoile = $nombreEtoile;

        return $this;
    }

    public function getNumeroTelephone(): ?int
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(int $numeroTelephone): self
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    /**
     * @return Collection|Chambre[]
     */
    public function getChambre(): Collection
    {
        return $this->chambre;
    }

    public function addChambre(Chambre $chambre): self
    {
        if (!$this->chambre->contains($chambre)) {
            $this->chambre[] = $chambre;
            $chambre->setHotel($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambre->contains($chambre)) {
            $this->chambre->removeElement($chambre);
            // set the owning side to null (unless already changed)
            if ($chambre->getHotel() === $this) {
                $chambre->setHotel(null);
            }
        }

        return $this;
    }

   

    /**
     * @return Collection|CaracteristiqueHotel[]
     */
    public function getCaracteristiqueHotels(): Collection
    {
        return $this->caracteristiqueHotels;
    }

    public function addCaracteristiqueHotel(CaracteristiqueHotel $caracteristiqueHotel): self
    {
        if (!$this->caracteristiqueHotels->contains($caracteristiqueHotel)) {
            $this->caracteristiqueHotels[] = $caracteristiqueHotel;
            $caracteristiqueHotel->setHotel($this);
        }

        return $this;
    }

    public function removeCaracteristiqueHotel(CaracteristiqueHotel $caracteristiqueHotel): self
    {
        if ($this->caracteristiqueHotels->contains($caracteristiqueHotel)) {
            $this->caracteristiqueHotels->removeElement($caracteristiqueHotel);
            // set the owning side to null (unless already changed)
            if ($caracteristiqueHotel->getHotel() === $this) {
                $caracteristiqueHotel->setHotel(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
