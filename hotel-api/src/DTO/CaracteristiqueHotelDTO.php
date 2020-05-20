<?php

namespace App\DTO;

use App\Entity\Hotel;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Un objet DTO (Data Transfer Object)
 */
class CaracteristiqueHotelDTO {

    private $parking;
    private $bar;
    private $climatiseur;
    private $restaurant;
    private $petitDejeuner;
    private $hotel;


    public function __construct(bool $parking, bool $bar, bool $climatiseur, bool $restaurant, bool $petitDejeuner, Hotel $hotel){
        $this->parking = $parking;
        $this->bar = $bar;
        $this->climatiseur = $climatiseur;
        $this->restaurant =$restaurant;
        $this->petitDejeuner =$petitDejeuner;
        $this->hotel = $hotel;
    }
    
    
    /**
     * Get the value of parking
     */ 
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * Set the value of parking
     *
     * @return  self
     */ 
    public function setParking($parking)
    {
        $this->parking = $parking;

        return $this;
    }

    /**
     * Get the value of bar
     */ 
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * Set the value of bar
     *
     * @return  self
     */ 
    public function setBar($bar)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get the value of climatiseur
     */ 
    public function getClimatiseur()
    {
        return $this->climatiseur;
    }

    /**
     * Set the value of climatiseur
     *
     * @return  self
     */ 
    public function setClimatiseur($climatiseur)
    {
        $this->climatiseur = $climatiseur;

        return $this;
    }

    /**
     * Get the value of restaurant
     */ 
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * Set the value of restaurant
     *
     * @return  self
     */ 
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get the value of petitDejeuner
     */ 
    public function getPetitDejeuner()
    {
        return $this->petitDejeuner;
    }

    /**
     * Set the value of petitDejeuner
     *
     * @return  self
     */ 
    public function setPetitDejeuner($petitDejeuner)
    {
        $this->petitDejeuner = $petitDejeuner;

        return $this;
    }

    /**
     * Get the value of hotel
     */ 
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set the value of hotel
     *
     * @return  self
     */ 
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }
}