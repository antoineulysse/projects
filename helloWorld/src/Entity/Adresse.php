<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresseRepository")
 */
class Adresse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     *  @Assert\Length(max=10, maxMessage="Message trop long (pas plus de 255 caractères)" , allowEmptyString=false,)
     */
    private $numeroRue;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(max=255, maxMessage="Message trop long (pas plus de 255 caractères)" , allowEmptyString=false,)
     */
    private $nomRue;

    /**
     * @ORM\Column(type="string", length=10)
     *  @Assert\Length(min=1, minMessage="Trois caracteres au minimum pour le Post", allowEmptyString=false,
     *                max=10, maxMessage="Message trop long (pas plus de 10 caractères)" )
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=100)
     *  @Assert\Length(min=1, minMessage="Trois caracteres au minimum pour le Post", allowEmptyString=false,
     *                max=100, maxMessage="Message trop long (pas plus de 100 caractères)" )
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=30)
     *  @Assert\Length(min=1, minMessage="Trois caracteres au minimum pour le Post", allowEmptyString=false,
     *                max=30, maxMessage="Message trop long (pas plus de 100 caractères)" )
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Person", mappedBy="Adresse")
     * 
     */
    private $people;

    public function __construct()
    {
        $this->people = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroRue(): ?string
    {
        return $this->numeroRue;
    }

    public function setNumeroRue(?string $numeroRue): self
    {
        $this->numeroRue = $numeroRue;

        return $this;
    }

    public function getNomRue(): ?string
    {
        return $this->nomRue;
    }

    public function setNomRue(string $nomRue): self
    {
        $this->nomRue = $nomRue;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people[] = $person;
            $person->setAdresse($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->people->contains($person)) {
            $this->people->removeElement($person);
            // set the owning side to null (unless already changed)
            if ($person->getAdresse() === $this) {
                $person->setAdresse(null);
            }
        }

        return $this;
    }
}
