<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, minMessage="Trois caracteres au minimum pour le Post", allowEmptyString=false,
     *                max=255, maxMessage="Message trop long (pas plus de 255 caractères)" )
     */
    private $Contents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="IdComments")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="IdComments")
     */
    private $IdPost;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Notification", mappedBy="Comments", cascade={"persist", "remove"})
     */
    private $notification;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContents(): ?string
    {
        return $this->Contents;
    }

    public function setContents(string $Contents): self
    {
        $this->Contents = $Contents;

        return $this;
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

    public function getIdPost(): ?Post
    {
        return $this->IdPost;
    }

    public function setIdPost(?Post $IdPost): self
    {
        $this->IdPost = $IdPost;

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
        $newComments = null === $notification ? null : $this;
        if ($notification->getComments() !== $newComments) {
            $notification->setComments($newComments);
        }

        return $this;
    }
}
