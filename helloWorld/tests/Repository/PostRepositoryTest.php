<?php

namespace App\Tests\Repository;

use App\Entity\Post;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\EmptyFixtures;
use App\Entity\User;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostRepositoryTest extends WebTestCase{

use FixturesTrait;

/**
 * Prepares the tests
 * @before
 * @return void
 */

public function setUp(){

    self::bootKernel();
}     

public function testFindAllReturnsAllPost(){
    $this->loadFixtures([AppFixtures::class]);
    $users = self::$container->get(PostRepository::class)->findAll();
    $this->assertCount(9, $users);
}

public function testFindById(){
    $this->loadFixtures([AppFixtures::class]);
    $users = self::$container->get(PostRepository::class)->find(1);
    $this->assertInstanceOf(Post::class,$users);
    $this->assertEquals(1, $users->getId());
}


public function testInsertion(){
    

    $user= (new User())->setEmail("azerty@gmail.com")
                        ->setUsername("dupond")
                        ->setPassword(1234);
    $post =(new Post())->setContent("test content")
                        -> setIdUser($user);
                               
                              
    $manager = self::$container->get('doctrine.orm.entity_manager');
    $manager->persist($user);
    $manager->persist($post);
    $manager->flush();
    $postTrouvee = self::$container->get(PostRepository::class)->find($post);

    $this->assertNotNull($postTrouvee);
    $this->assertEquals("test content", $postTrouvee->getContent());
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