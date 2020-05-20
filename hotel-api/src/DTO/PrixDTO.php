<?php

namespace App\DTO;

use phpDocumentor\Reflection\Types\Integer;

/**
 * Un objet DTO (Data Transfer Object)
 */
class PrixDTO {

    private $prixChambre;
    private $tarif;
    private $typeChambreDTO;

    public function __construct(string $prixChambre, Integer $tarif, TypeChambreDTO $typeChambreDTO){
        $this->prixChambre = $prixChambre;
        $this->tarif = $tarif;
        $this->typeChambreDTO = $typeChambreDTO;
    }

   

    /**
     * Get the value of prixChambre
     */ 
    public function getPrixChambre()
    {
        return $this->prixChambre;
    }

    /**
     * Set the value of prixChambre
     *
     * @return  self
     */ 
    public function setPrixChambre($prixChambre)
    {
        $this->prixChambre = $prixChambre;

        return $this;
    }

    /**
     * Get the value of tarif
     */ 
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set the value of tarif
     *
     * @return  self
     */ 
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get the value of typeChambreDTO
     */ 
    public function getTypeChambreDTO()
    {
        return $this->typeChambreDTO;
    }

    /**
     * Set the value of typeChambreDTO
     *
     * @return  self
     */ 
    public function setTypeChambreDTO($typeChambreDTO)
    {
        $this->typeChambreDTO = $typeChambreDTO;

        return $this;
    }
}

