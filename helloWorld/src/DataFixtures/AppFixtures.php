<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Comments;
use App\Entity\Image;
use App\Entity\Liker;
use App\Entity\Notification;
use App\Entity\Person;
use App\Entity\Post;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    
    public function load(ObjectManager $manager)
    {
      

        for($i=0; $i<mt_rand(3,3); $i++){
            $user=$this-> createUser($i);
            $manager->persist($user);
            for($j=0; $j<mt_rand(3,3); $j++){
                $post=$this->createPost($user);
                $manager->persist($post);
                for($k=0; $k<mt_rand(3,3); $k++){
                    $comment = $this->createComment($user, $post);
                    $manager->persist($comment);
                }
                for($l=0; $l<mt_rand(3,3); $l++){
                    $liker = $this->createLiker($user, $post);
                    $manager->persist($liker);
                }
                for($m=0; $m <mt_rand(1,1); $m++) {
                    $image = $this->createImage($post);
                    $manager->persist($image);
                }
                for($n=0; $n <mt_rand(3,3); $n++) {
                    $notification = $this->createNotification($user);
                    $manager->persist($notification);
                }       

            }

        }

        $manager->flush();
    }

    private function createUser($i){
       
        $user = new User();
        $user -> setEmail("azerty@gmail.com".$i);
        $user-> setPassword("01234".$i);
        $user-> setUsername("test".$i);
        return $user;
    }
    private function createAdresse(){
       
        $adresse = new Adresse();
        $adresse -> setNumeroRue(mt_rand(1,200));
        $adresse -> setNomRue ("Rue du" );
        $adresse -> setCodepostal (mt_rand(10000, 99000));
        $adresse -> setVille("Ville-" );
        $adresse -> setPays ("Pays-");
        return $adresse;

    }
    private function createPerson(){
        $person = new Person();
        $person->setPrenom('Prénom ');
        $person->setNom("NOM");
        $person->setSalaire(mt_rand(1000, 10000));
        $adresse = $this->createAdresse();
        $adresse -> addPerson($person);
        $person -> setAdresse($adresse);
        return $person;
    }
    private function createComment($user, $post){
        $faker = Factory::create('FR-fr');
        $comment = new Comments();
        $comment -> setIdUser($user);
        $comment -> setIdPost($post);
        $comment->setContents($faker->sentence());
        return $comment;

    }
   private function createLiker($user, $post){
        $liker = new Liker();
        $liker -> setPost($post);
        $liker -> setIdUser($user);
        return $liker;
    } 
    private function createPost(User $user){
        $faker = Factory::create('FR-fr');
        $post = new Post();
        $post -> setContent($faker->sentence());
        $post-> setIdUser($user);
        $post-> setCreatedAt(new \DateTime());
        return $post;
    }


    private function createImage ($post){
        $faker = Factory::create('FR-fr');
        $image = new Image();
        $image->setUrl($faker->imageUrl());
        $image ->setcaption($faker->sentence());  
        $image-> setAd($post);
        return $image;
    }

    private function createNotification(User $user){
        $faker = Factory::create('FR-fr');
        $notification = new Notification();
        $notification -> setUser($user);
        $notification->setNotif($faker->sentence());
        return $notification;
    }
}