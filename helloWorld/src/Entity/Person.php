<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 * @ApiResource
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
/* */
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min=3, minMessage="Trois caracteres au minimum pour le prénom", allowEmptyString=false,
     *                max=50, maxMessage="Prénom trop long (pas plus de 50 caractères)" )
     */
    private $prenom;
/* */
    /**
     * @ORM\Column(type="string", length=50)
    * @Assert\Length(min=3, minMessage="Trois caracteres au minimum pour le nom", allowEmptyString=false,
    *                max=50, maxMessage="Nom trop long (pas plus de 50 caractères)" )
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $salaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", inversedBy="people", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Adresse;

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

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->Adresse;
    }

    public function setAdresse(?Adresse $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
        
    }

   
}
