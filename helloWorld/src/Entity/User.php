<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields={"email"},
 * message="l'email que vous avez indiqué est déjà utilisé"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\length(min="8", minMessage="Votre mot de passe doit faire au minimum 8 caractères")
     * 
     * 
     */
    private $password;
    /**
     *  @Assert\EqualTo(propertyPath="confirm_password", message="votre de passe doit etre le meme")
     */

    public $confirm_password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="idUser")
     */
    private $idPost;

    

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="idUser")
     */
    private $IdComments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="User", orphanRemoval=true)
     */
    private $notifications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NotificationUser", mappedBy="User")
     */
    private $notificationUsers;

   

   

    public function __construct()
    {
        $this->IdLike = new ArrayCollection();
        $this->IdComments = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->notificationUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials()
    {
        
    }
    public function getSalt()
    {
        
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getIdPost(): ?Post
    {
        return $this->idPost;
    }

    public function setIdPost(?Post $idPost): self
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * @return Collection|Liker[]
     */
    public function getIdLiker(): Collection
    {
        return $this->IdLiker;
    }

    public function addIdLike(Liker $idLiker): self
    {
        if (!$this->IdLike->contains($idLiker)) {
            $this->IdLike[] = $idLiker;
            $idLiker->setIdUser($this);
        }

        return $this;
    }

    public function removeIdLike(Liker $idLiker): self
    {
        if ($this->IdLike->contains($idLiker)) {
            $this->IdLike->removeElement($idLiker);
            // set the owning side to null (unless already changed)
            if ($idLiker->getIdUser() === $this) {
                $idLiker->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getIdComments(): Collection
    {
        return $this->IdComments;
    }

    public function addIdComment(Comments $idComment): self
    {
        if (!$this->IdComments->contains($idComment)) {
            $this->IdComments[] = $idComment;
            $idComment->setIdUser($this);
        }

        return $this;
    }

    public function removeIdComment(Comments $idComment): self
    {
        if ($this->IdComments->contains($idComment)) {
            $this->IdComments->removeElement($idComment);
            // set the owning side to null (unless already changed)
            if ($idComment->getIdUser() === $this) {
                $idComment->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setUser($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->contains($notification)) {
            $this->notifications->removeElement($notification);
            // set the owning side to null (unless already changed)
            if ($notification->getUser() === $this) {
                $notification->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NotificationUser[]
     */
    public function getNotificationUsers(): Collection
    {
        return $this->notificationUsers;
    }

    public function addNotificationUser(NotificationUser $notificationUser): self
    {
        if (!$this->notificationUsers->contains($notificationUser)) {
            $this->notificationUsers[] = $notificationUser;
            $notificationUser->setUser($this);
        }

        return $this;
    }

    public function removeNotificationUser(NotificationUser $notificationUser): self
    {
        if ($this->notificationUsers->contains($notificationUser)) {
            $this->notificationUsers->removeElement($notificationUser);
            // set the owning side to null (unless already changed)
            if ($notificationUser->getUser() === $this) {
                $notificationUser->setUser(null);
            }
        }

        return $this;
    }

   

}
