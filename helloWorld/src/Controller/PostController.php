<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Liker;
use App\Entity\Notification;
use App\Entity\NotificationUser;
use App\Entity\Post;
use App\Entity\User;
use App\Form\CommentsType;
use App\Form\LikerType;
use App\Form\PostType;
use App\Repository\LikerRepository;
use App\Repository\NotificationRepository;
use App\Repository\PostRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(PostRepository $repo)
    {
        $post = $repo->findAll();
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'repo' =>$post
        ]);
    }
    /**
     * @route("/home", name="home") 
     * @Route("/")
     * 
     */
    public Function home(Request $request) {

        $repo=$this->getDoctrine()->getRepository(Post::class) ;
        $posts =$repo->findAll();
        dump($posts);

        $repo3=$this->getDoctrine()->getRepository(NotificationUser::class);
        $user=$this->getUser();
        $notificationUsers = $repo3->findBy(array('isViewed'=>0, 'User' => $user), array('id' => 'DESC'));
        dump($notificationUsers);
    
        $repo2=$this->getDoctrine()->getRepository(User::class) ;
        $Users =$repo2->findAll();


        $post= new Post();
    
        $form = $this->createForm(PostType::class, $post); 
               
        $form->handleRequest($request);
        
       if($form->isSubmitted() && $form->isValid()){
           if (!$post->getId()){
               $post->setCreatedAt(new \DateTime());
           }
            $file = $post->getPhoto();
            $post->setPhoto(file_get_contents($file));
            $user=$this->getUser();
            $post->setIdUser($user);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($post);
       
            $notification = new Notification();
            $user=$this->getUser();
            $notification->setUser($user);
            $notification->setPost($post);
            $notification->setPostOrigin($post);
            $username= $user->getUsername();
            $notification -> setNotif($username.' a publié un nouveau Post');
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($notification);

            foreach ($Users as $user){
                $notificationUser = new NotificationUser();
                $notificationUser->setUser($user);
                $notificationUser->setIsViewed(false);
                $notificationUser->setNotification($notification);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($notificationUser);
            
                $manager->flush();
            } 
    
        }
        return $this->render('post/home.html.twig',[
            'title' =>'Bienvenue sur le nouveau réseau social de l\'entreprise !',
            // 'comments'=> $comments,
            'posts' => $posts,
            'formPost'=> $form->createView(),
            'notificationUsers' => $notificationUsers
          
        ]);

        return $this->render('base.html.twig',[
            'title' =>'Bienvenue sur le nouveau réseau social de l\'entreprise !',
            // 'comments'=> $comments,
            'posts' => $posts,
            'formPost'=> $form->createView(),
            'notificationUsers' => $notificationUsers
          
        ]);
     
    }
    /**
      * @Route("home/{id}", name="post_show", )
     */
        public function show(NotificationRepository $notifrepo, Post $post): Response {
            
           
            
            return $this->render('post/show.html.twig',[
                'post'=> $post,
                'notification' => $notifrepo
            ]);
    }

    /**
     * permet de liker et unliker un post
     * 
     * @Route("/home/{id}/like", name="post_like")
     * @param \App\Entity\Post $posts
     * @param \Doctrine\common\Persistence\ObjectManager $manager
     * @param \App\Repository\LikerRepository $likerRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function like(Post $post, ObjectManager $manager, LikerRepository $likerRepository) : Response  {

        $user = $this->getUser();
        if(!$user) return $this->json([
            'code' => 403,
            'message' => "Unauthorized"
        ],403);

        if($post->isLikedByUser($user)) {
            $like = $likerRepository->findOneBy([
                'post'=> $post,
                'idUser' => $user
            ]);
            $manager->remove($like);
            $manager->flush();

            return $this->json([
                'code'=>200,
                'message' => 'like bien supprimé',
                'liker' => $likerRepository->count(['post' => $post])
            ],200);

        }
        $repo2=$this->getDoctrine()->getRepository(User::class) ;
        $Users =$repo2->findAll();

        $like = new Liker();

        $like->setPost($post)
             ->setIdUser($user);
            $manager->persist($like);
            $notification = new Notification();
            $user=$this->getUser();
            $notification->setUser($user);
            $notification->setLiker($like);
            $notification->setPostOrigin($post);
            $username= $user->getUsername();
            $notification -> setNotif($username.' a publié un like');
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($notification);

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

        return $this->json([
            'code' =>200 ,
            'message'=> 'like bien ajouté',
            'likes' => $likerRepository->count(['post'=>$post]) 
        ],200);
    }

    /**
     * @route("/home/{id}/post/delete", name="post_delete")
     * 
     * 
     */
    public function delete(Post $post){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($post);
   
        $manager->flush();
        return $this->redirectToRoute('home');
        
    }


    /**
     * @Route("/home/{id}/false", name="notification_flag")
     * 
     */

     public function notificationisViewed(NotificationUser $notificationUser){

        $manager = $this->getDoctrine()->getManager();
        $notificationUser->setIsViewed(true); 
        $notif=$notificationUser->getNotification();
        $post=$notif->getPostOrigin();
        $id= $post->getId();
        $manager->persist($notificationUser);
        $manager->flush();

        return $this->redirectToRoute('post_show', array('id'=>$id));

    } 

}
