<?php

namespace App\Tests\Repository;


use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\EmptyFixtures;
use App\Entity\Comments;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\CommentsRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentsRepositoryTest extends WebTestCase{

use FixturesTrait;

/**
 * Prepares the tests
 * @before
 * @return void
 */

public function setUp(){

    self::bootKernel();
}     

public function testFindAllReturnsAllComments(){
    $this->loadFixtures([AppFixtures::class]);
    $users = self::$container->get(CommentsRepository::class)->findAll();
    $this->assertCount(27, $users);
}

public function testFindById(){
    $this->loadFixtures([AppFixtures::class]);
    $users = self::$container->get(CommentsRepository::class)->find(1);
    $this->assertInstanceOf(Comments::class,$users);
    $this->assertEquals(1, $users->getId());
}


public function testInsertion(){
    

    $user= (new User()) ->setEmail("azerty@gmail.com")
                        ->setUsername("dupond")
                        ->setPassword(1234);
    $post =(new Post())->setContent("test content") ;                   
    $comment =(new Comments()) ->setContents("test content")
                                ->setIdPost($post)
                                -> setIdUser($user);
                               
                              
    $manager = self::$container->get('doctrine.orm.entity_manager');
    $manager->persist($user);
    $manager->persist($post);
    $manager->persist($comment);
    $manager->flush();
    $commentTrouvee = self::$container->get(CommentsRepository::class)->find($comment);

    $this->assertNotNull($commentTrouvee);
    $this->assertEquals("test content", $commentTrouvee->getContents());
}


/**
 * stops the kernel
 * @after
 * @return void
 */

public function closeTests(){
    self::ensureKernelShutdown();
    $this->loadFixtures([EmptyFixtures::class]);
    
}
}