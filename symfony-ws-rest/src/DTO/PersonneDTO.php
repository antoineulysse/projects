<?php

namespace App\DTO;

/**
 * Un objet DTO (Data Transfer Object)
 */
class PersonneDTO {

    private $prenom;
    private $nom;
    private $informationContactDTO;

    public function __construct(string $prenom, string $nom, InformationContactDTO $informationContactDTO){
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->informationContactDTO = $informationContactDTO;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }


    /**
     * Get the value of informationContactDTO
     */ 
    public function getInformationContactDTO()
    {
        return $this->informationContactDTO;
    }

    /**
     * Set the value of informationContactDTO
     *
     * @return  self
     */ 
    public function setInformationContactDTO($informationContactDTO)
    {
        $this->informationContactDTO = $informationContactDTO;

        return $this;
    }

}