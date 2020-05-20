<?php

namespace App\Controller;
use App\Entity\Post;
use App\Entity\Comments;
use App\Entity\Notification;
use App\Entity\NotificationUser;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CommentsController extends AbstractController
{
    /**
     * @Route("/comments", name="comments")
     */
    public function index()
    {
        return $this->render('comments/index.html.twig', [
            'controller_name' => 'CommentsController',
        ]);
    }
    /**
     * @Route ("/commentaire/{id}", name= "commentaire")
     */

    public function commentaire(Post $idPost, Request $request){
        
        $comment= new Comments();
        $user=$this->getUser();
        $comment->setIdUser($user);
        $idContent=$request->request->get('commentaire');
        $comment->setContents($idContent);
        
        $comment->setIdPost($idPost);

          $manager = $this->getDoctrine()->getManager();

          $manager->persist($comment);


          $notification = new Notification();
          $user=$this->getUser();
          $notification->setUser($user);
          $notification->setComments($comment);
          $notification->setPostOrigin($idPost);
          $username= $user->getUsername();
          $notification -> setNotif($username.' a publié un nouveau commentaire');
          $manager = $this->getDoctrine()->getManager();
          $manager->persist($notification);  

          $repo2=$this->getDoctrine()->getRepository(User::class) ;
        $Users =$repo2->findAll();

          foreach ($Users as $user){
            $notificationUser = new NotificationUser();
            $notificationUser->setUser($user);
            $notificationUser->setIsViewed(false);
            $notificationUser->setNotification($notification);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($notificationUser);
        
            $manager->flush();
        } 
          $manager->flush();

          return $this->redirectToRoute('home');
    
    }
    /**
     * @route("/home/{id}/comment/delete", name="comment_delete")
     * 
     * 
     */
    public function delete(Comments $comment){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($comment);
   
        $manager->flush();
        return $this->redirectToRoute('home');
        
    }

}
