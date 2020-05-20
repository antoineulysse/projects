<?php

namespace App\Entity;

use App\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Node\Expr\Cast\Bool_;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3, minMessage="Trois caracteres au minimum pour le Post", allowEmptyString=false,
     *                max=255, maxMessage="Message trop long (pas plus de 255 caractères)" )
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="idPost")
     */
    private $idUser;

   

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="IdPost", orphanRemoval=true)
     
     */
    private $IdComments;

  


    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="ad", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $images;

    

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $Photo;

    /**
     * 
     */

    private $rawPhoto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Liker", mappedBy="post", orphanRemoval=true)
     */
    private $Liker;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Notification", mappedBy="Post", cascade={"persist", "remove"})
     */
    private $notification;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="PostOrigin", orphanRemoval=true)
     */
    private $notifPostOrigin;


    public function displayPhoto(){

        if(null === $this->rawPhoto) {
            $this->rawPhoto = "data:image/png;base64," . base64_encode(stream_get_contents($this->getPhoto()));
        }

        return $this->rawPhoto;
    }

    

    public function __construct()
    {
        $this->IdLike = new ArrayCollection();
        $this->IdComments = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->Liker = new ArrayCollection();
        $this->notifPostOrigin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }




    /**
     * @return User
     */
    public function getIdUser(): User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser):self
    {
        $this->idUser=$idUser;
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
            $idComment->setIdPost($this);
        }

        return $this;
    }

    public function removeIdComment(Comments $idComment): self
    {
        if ($this->IdComments->contains($idComment)) {
            $this->IdComments->removeElement($idComment);
            // set the owning side to null (unless already changed)
            if ($idComment->getIdPost() === $this) {
                $idComment->setIdPost(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAd($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getAd() === $this) {
                $image->setAd(null);
            }
        }

        return $this;
    }

    public function getPhoto()
    {
        return $this->Photo;
    }

    public function setPhoto($Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }
    /**
     * permet de savoir liker un utlisateur
     * @param User $user
     * @return boolean
     */
    public function isLikedByUser (User $user) : bool {
        foreach($this->Liker as $Liker) {
            if ($Liker->getIdUser() === $user) return true;
        }

        return false;
        
    }

    /**
     * @return Collection|Liker[]
     */
    public function getLiker(): Collection
    {
        return $this->Liker;
    }

    public function addLiker(Liker $liker): self
    {
        if (!$this->Liker->contains($liker)) {
            $this->Liker[] = $liker;
            $liker->setPost($this);
        }

        return $this;
    }

    public function removeLiker(Liker $liker): self
    {
        if ($this->Liker->contains($liker)) {
            $this->Liker->removeElement($liker);
            // set the owning side to null (unless already changed)
            if ($liker->getPost() === $this) {
                $liker->setPost(null);
            }
        }

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
        $newPost = null === $notification ? null : $this;
        if ($notification->getPost() !== $newPost) {
            $notification->setPost($newPost);
        }

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifPostOrigin(): Collection
    {
        return $this->notifPostOrigin;
    }

    public function addNotifPostOrigin(Notification $notifPostOrigin): self
    {
        if (!$this->notifPostOrigin->contains($notifPostOrigin)) {
            $this->notifPostOrigin[] = $notifPostOrigin;
            $notifPostOrigin->setPostOrigin($this);
        }

        return $this;
    }

    public function removeNotifPostOrigin(Notification $notifPostOrigin): self
    {
        if ($this->notifPostOrigin->contains($notifPostOrigin)) {
            $this->notifPostOrigin->removeElement($notifPostOrigin);
            // set the owning side to null (unless already changed)
            if ($notifPostOrigin->getPostOrigin() === $this) {
                $notifPostOrigin->setPostOrigin(null);
            }
        }

        return $this;
    }

   
}
