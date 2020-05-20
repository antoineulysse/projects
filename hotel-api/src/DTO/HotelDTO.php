<?php

namespace App\DTO;
use App\Entity\Adresse;
use App\Entity\CaracteristiqueHotel;
use App\Entity\Chambre;

/**
 * Un objet DTO (Data Transfer Object)
 */
class HotelDTO {

    private $nomHotel;
    private $nombreEtoile;
    private $numeroTelephone;
    private $chambre;
    private $caracteristiqueHotel;
    private $adresse;

    public function __construct(string $nomHotel, string $nombreEtoile,string $numeroTelephone, Chambre $chambre, CaracteristiqueHotel $caracteristiqueHotel, Adresse $adresse){
        $this->nomHotel = $nomHotel;
        $this->nombreEtoile = $nombreEtoile;
        $this->numeroTelephone = $numeroTelephone;        
        $this->Chambre = $chambre;
        $this->caracteristiqueHotel = $caracteristiqueHotel;
        $this->Adresse = $adresse;
    }


    /**
     * Get the value of nomHotel
     */ 
    public function getNomHotel()
    {
        return $this->nomHotel;
    }

    /**
     * Set the value of nomHotel
     *
     * @return  self
     */ 
    public function setNomHotel($nomHotel)
    {
        $this->nomHotel = $nomHotel;

        return $this;
    }

    /**
     * Get the value of nombreEtoile
     */ 
    public function getNombreEtoile()
    {
        return $this->nombreEtoile;
    }

    /**
     * Set the value of nombreEtoile
     *
     * @return  self
     */ 
    public function setNombreEtoile($nombreEtoile)
    {
        $this->nombreEtoile = $nombreEtoile;

        return $this;
    }

    /**
     * Get the value of numeroTelephone
     */ 
    public function getNumeroTelephone()
    {
        return $this->numeroTelephone;
    }

    /**
     * Set the value of numeroTelephone
     *
     * @return  self
     */ 
    public function setNumeroTelephone($numeroTelephone)
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    /**
     * Get the value of chambre
     */ 
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Set the value of chambre
     *
     * @return  self
     */ 
    public function setChambre($chambre)
    {
        $this->chambre = $chambre;

        return $this;
    }

    

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of caracteristiqueHotel
     */ 
    public function getCaracteristiqueHotel()
    {
        return $this->caracteristiqueHotel;
    }

    /**
     * Set the value of caracteristiqueHotel
     *
     * @return  self
     */ 
    public function setCaracteristiqueHotel($caracteristiqueHotel)
    {
        $this->caracteristiqueHotel = $caracteristiqueHotel;

        return $this;
    }
}