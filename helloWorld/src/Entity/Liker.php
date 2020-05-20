<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikerRepository")
 */
class Liker
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="Liker")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Notification", mappedBy="liker", cascade={"persist", "remove"})
     */
    private $notification;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getNotification(): ?Notification
    {
        return $this->notification;
    }

    public function setNotification(?Notification $notification): self
    {
        $this->notification = $notification;

        // set (or unset) the owning side of the relation if necessary
        $newLiker = null === $notification ? null : $this;
        if ($notification->getLiker() !== $newLiker) {
            $notification->setLiker($newLiker);
        }

        return $this;
    }


}
