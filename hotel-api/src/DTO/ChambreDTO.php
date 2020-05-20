<?php

namespace App\DTO;

use App\Entity\Hotel;
use App\Entity\TypeChambre;
use Doctrine\DBAL\Types\BlobType;

/**
 * Un objet DTO (Data Transfer Object)
 */
class ChambreDTO {

    private $television;
    private $internet;
    // private $photoChambre;
    private $typeChambre;
    private $hotel;

    public function __construct(bool $television, bool $internet, TypeChambre $typeChambre, Hotel $hotel){
        $this->television = $television;
        $this->internet = $internet;
        $this->typeChambre = $typeChambre;
        $this->hotel = $hotel;
    }

  
    /**
     * Get the value of internet
     */ 
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set the value of internet
     *
     * @return  self
     */ 
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get the value of typeChambre
     */ 
    public function getTypeChambre()
    {
        return $this->typeChambre;
    }

    /**
     * Set the value of typeChambre
     *
     * @return  self
     */ 
    public function setTypeChambre($typeChambre)
    {
        $this->typeChambre = $typeChambre;

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

    /**
     * Get the value of television
     */ 
    public function getTelevision()
    {
        return $this->television;
    }

    /**
     * Set the value of television
     *
     * @return  self
     */ 
    public function setTelevision($television)
    {
        $this->television = $television;

        return $this;
    }
}