<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChambreRepository")
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $television;

    /**
     * @ORM\Column(type="boolean")
     */
    private $internet;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $photoChambre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeChambre", mappedBy="chambre")
     */
    private $typeChambres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="chambre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

    public function __construct()
    {
        $this->typeChambres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelevision(): ?bool
    {
        return $this->television;
    }

    public function setTelevision(bool $television): self
    {
        $this->television = $television;

        return $this;
    }

    public function getInternet(): ?bool
    {
        return $this->internet;
    }

    public function setInternet(bool $internet): self
    {
        $this->internet = $internet;

        return $this;
    }

    public function getPhotoChambre()
    {
        return $this->photoChambre;
    }

    public function setPhotoChambre($photoChambre): self
    {
        $this->photoChambre = $photoChambre;

        return $this;
    }

    /**
     * @return Collection|TypeChambre[]
     */
    public function getTypeChambres(): Collection
    {
        return $this->typeChambres;
    }

    public function addTypeChambre(TypeChambre $typeChambre): self
    {
        if (!$this->typeChambres->contains($typeChambre)) {
            $this->typeChambres[] = $typeChambre;
            $typeChambre->setChambre($this);
        }

        return $this;
    }

    public function removeTypeChambre(TypeChambre $typeChambre): self
    {
        if ($this->typeChambres->contains($typeChambre)) {
            $this->typeChambres->removeElement($typeChambre);
            // set the owning side to null (unless already changed)
            if ($typeChambre->getChambre() === $this) {
                $typeChambre->setChambre(null);
            }
        }

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
