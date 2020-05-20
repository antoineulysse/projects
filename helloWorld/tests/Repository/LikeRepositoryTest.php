<?php

namespace App\Tests\Repository;


use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\EmptyFixtures;
use App\Entity\Liker;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\LikerRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LikeRepositoryTest extends WebTestCase{

use FixturesTrait;

/**
 * Prepares the tests
 * @before
 * @return void
 */

public function setUp(){

    self::bootKernel();
}     

public function testInsertion(){
    

    $user= (new User())->setEmail("azerty@gmail.com")
                        ->setUsername("dupond")
                        ->setPassword(1234);
    $post =(new Post())->setContent("test content");
    $like =(new Liker())-> setIdPost($post)  
                        -> setIdUser($user);
                               
                              
    $manager = self::$container->get('doctrine.orm.entity_manager');
    $manager->persist($user);
    $manager->persist($post);
    $manager->persist($like);
    $manager->flush();
    $postTrouvee = self::$container->get(LikerRepository::class)->find($like);

    $this->assertNotNull($postTrouvee);
    $this->assertEquals(1, $postTrouvee->getIdUser()->getId());
}

 public function testFindAllReturnsAllLike(){
    $this->loadFixtures([AppFixtures::class]);
    $users = self::$container->get(LikerRepository::class)->findAll();
    $this->assertCount(27, $users);
}

public function testFindById(){
    $this->loadFixtures([AppFixtures::class]);
    $users = self::$container->get(LikerRepository::class)->find(1);
    $this->assertInstanceOf(Liker::class,$users);
    $this->assertEquals(1, $users->getId());
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