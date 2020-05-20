<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneRepository")
 */
class Personne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;
    
    /**
     * 
     * @ORM\Embedded(class="InformationContact", columnPrefix=false)
     * @var InformationContact
     */
    private $informationContact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of informationContact
     */ 
    public function getInformationContact()
    {
        return $this->informationContact;
    }

    /**
     * Set the value of informationContact
     *
     * @return  self
     */ 
    public function setInformationContact($informationContact)
    {
        $this->informationContact = $informationContact;

        return $this;
    }
}
