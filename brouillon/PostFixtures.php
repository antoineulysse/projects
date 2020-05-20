<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixture // extends Fixture
{

   // public function load(ObjectManager $manager){
        // create 10 posts
      
       for ($i = 1; $i < 10; $i++) {
            $post = new Post();
            $post->setContent('test contenu '.$i);
            $user=$this->createUser($i);
            $manager->persist($user);
            $post->setIdUser($user);
            $user-> setIdPost($post);
            $manager->persist($post);

        
        }

        $manager->flush();

   // }
    private function createUser(int $i){
        $user = new User();
        $user -> setEmail("azerty@gmail.com".$i);
        $user -> setUsername("adbk".$i);
        $user -> setPassword("1234".$i);
        return $user;
    }
}

