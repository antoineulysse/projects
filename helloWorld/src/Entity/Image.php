<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caption;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     */
    private $ad;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $upload;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getAd(): ?Post
    {
        return $this->ad;
    }

    public function setAd(?Post $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    public function getUpload()
    {
        return $this->upload;
    }

    public function setUpload($upload): self
    {
        $this->upload = $upload;

        return $this;
    }
}
