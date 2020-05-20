<?php

namespace App\DTO;

use App\Entity\Hotel;
use Doctrine\ORM\Mapping as ORM;


class AdresseDTO {

    private $numeroRue;
    private $NomRue;
    private $codePostal;
    private $ville;
    private $Pays;
    private $hotel;


    public function __construct(string $numeroRue,string $NomRue, string $codePostal, string $ville, string $Pays, Hotel $hotel){
        $this->numeroRue = $numeroRue;
        $this->NomRue = $NomRue;
        $this->codePostal = $codePostal;
        $this->ville =$ville;
        $this->Pays =$Pays;
        $this->Hotel =$hotel;
    }    


    /**
     * Get the value of numeroRue
     */ 
    public function getNumeroRue()
    {
        return $this->numeroRue;
    }

    /**
     * Set the value of numeroRue
     *
     * @return  self
     */ 
    public function setNumeroRue($numeroRue)
    {
        $this->numeroRue = $numeroRue;

        return $this;
    }

    /**
     * Get the value of NomRue
     */ 
    public function getNomRue()
    {
        return $this->NomRue;
    }

    /**
     * Set the value of NomRue
     *
     * @return  self
     */ 
    public function setNomRue($NomRue)
    {
        $this->NomRue = $NomRue;

        return $this;
    }

    /**
     * Get the value of codePostal
     */ 
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set the value of codePostal
     *
     * @return  self
     */ 
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of Pays
     */ 
    public function getPays()
    {
        return $this->Pays;
    }

    /**
     * Set the value of Pays
     *
     * @return  self
     */ 
    public function setPays($Pays)
    {
        $this->Pays = $Pays;

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

    

   