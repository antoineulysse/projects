<?php

namespace App\DataFixtures;

use App\Entity\Comments;
use App\Entity\Liker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentsFixtures // extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++) {
            $comments = new Comments;
            $comments->setContents('test contenu'.$i);
           // $user=$this->createUser($i);
            //$manager->persist($user);
           // $comments->setIdUser($user);
           //$liker = $this->createLiker($i);
          // $manager->persist($liker);
            $comments->set;
        }    

        $manager->flush();
    }

  
}
