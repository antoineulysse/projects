<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 */
class Notification 
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
    private $notif;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Post", inversedBy="notification", cascade={"persist", "remove"})
     */
    private $Post;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Comments", inversedBy="notification", cascade={"persist", "remove"})
     */
    private $Comments;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Liker", inversedBy="notification", cascade={"persist", "remove"})
     */
    private $liker;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NotificationUser", mappedBy="notification")
     */
    private $notificationUsers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="notifPostOrigin")
     * @ORM\JoinColumn(nullable=false)
     */
    private $PostOrigin;

 

    

    public function __construct()
    {
        $this->User = new ArrayCollection();
        $this->notificationUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotif(): ?string
    {
        return $this->notif;
    }

    public function setNotif(string $notif): self
    {
        $this->notif = $notif;

        return $this;
    }

    

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(?Post $Post): self
    {
        $this->Post = $Post;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getComments(): ?Comments
    {
        return $this->Comments;
    }

    public function setComments(?Comments $Comments): self
    {
        $this->Comments = $Comments;

        return $this;
    }

    public function getLiker(): ?Liker
    {
        return $this->liker;
    }

    public function setLiker(?Liker $liker): self
    {
        $this->liker = $liker;

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
            $notificationUser->setNotification($this);
        }

        return $this;
    }

    public function removeNotificationUser(NotificationUser $notificationUser): self
    {
        if ($this->notificationUsers->contains($notificationUser)) {
            $this->notificationUsers->removeElement($notificationUser);
            // set the owning side to null (unless already changed)
            if ($notificationUser->getNotification() === $this) {
                $notificationUser->setNotification(null);
            }
        }

        return $this;
    }

    public function getPostOrigin(): ?Post
    {
        return $this->PostOrigin;
    }

    public function setPostOrigin(?Post $PostOrigin): self
    {
        $this->PostOrigin = $PostOrigin;

        return $this;
    }


    
}
