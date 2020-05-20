<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracteristiqueHotelRepository")
 */
class CaracteristiqueHotel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $parking;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $climatiseur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $restaurant;

    /**
     * @ORM\Column(type="boolean")
     */
    private $petitDejeuner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="caracteristiqueHotels")
     */
    private $hotel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParking(): ?bool
    {
        return $this->parking;
    }

    public function setParking(bool $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function getBar(): ?bool
    {
        return $this->bar;
    }

    public function setBar(bool $bar): self
    {
        $this->bar = $bar;

        return $this;
    }

    public function getClimatiseur(): ?bool
    {
        return $this->climatiseur;
    }

    public function setClimatiseur(bool $climatiseur): self
    {
        $this->climatiseur = $climatiseur;

        return $this;
    }

    public function getRestaurant(): ?bool
    {
        return $this->restaurant;
    }

    public function setRestaurant(bool $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    public function getPetitDejeuner(): ?bool
    {
        return $this->petitDejeuner;
    }

    public function setPetitDejeuner(bool $petitDejeuner): self
    {
        $this->petitDejeuner = $petitDejeuner;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
