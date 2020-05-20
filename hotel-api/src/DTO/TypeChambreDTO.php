<?php

namespace App\DTO;

use App\Entity\Chambre;

/**
 * Un objet DTO (Data Transfer Object)
 */
class TypeChambreDTO {

    private $capacite;
    private $type;
    private $chambre;
    private $prixDTO;

    public function __construct(string $capacite, string $type, Chambre $chambre, PrixDTO $prixDTO){
        $this->capacite = $capacite;
        $this->type = $type;
        $this->chambre =$chambre; 
        $this->prixDTO = $prixDTO;
    }

    


    /**
     * Get the value of capacite
     */ 
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set the value of capacite
     *
     * @return  self
     */ 
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get the value of prixDTO
     */ 
    public function getPrixDTO()
    {
        return $this->prixDTO;
    }

    /**
     * Set the value of prixDTO
     *
     * @return  self
     */ 
    public function setPrixDTO($prixDTO)
    {
        $this->prixDTO = $prixDTO;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

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
}