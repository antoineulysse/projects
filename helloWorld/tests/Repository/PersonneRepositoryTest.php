<?php

namespace App\Tests\Repository;

use App\Entity\Adresse;
use App\Entity\Person;
use App\Repository\PersonRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\PersonFixtures;
use App\DataFixtures\AppFixtures;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PersonneRepositoryTest extends WebTestCase{

    use FixturesTrait;

    /**
     * Prepares the tests
     * @before
     * @return void
     */

    public function setUp(){

        self::bootKernel();
    }     

    public function testFindAllReturnsAllPersons(){
        $this->loadFixtures([AppFixtures::class]);
        $users = self::$container->get(PersonRepository::class)->findAll();
        $this->assertCount(1, $users);
    }

    public function testFindById(){
        $this->loadFixtures([AppFixtures::class]);
        $users = self::$container->get(PersonRepository::class)->find(1);
        $this->assertInstanceOf(Person::class,$users);
        $this->assertEquals(1, $users->getId());
    }


    public function testInsertion(){
        $adresse =(new Adresse())->setNumeroRue("3")->setNomRue("Lisoire")->setCodePostal("59000")->setVille("Lille")->setPays("France");
        $personne= (new Person())->setPrenom("david")
                                   ->setNom("dupond")
                                   ->setSalaire(21312)
                                   ->setAdresse($adresse);
                                   
        $manager = self::$container ->get('doctrine.orm.entity_manager');
        $manager->persist($personne);
        $manager->flush();
        $personneTrouvee = self::$container->get(PersonRepository::class)->find($personne);

        $this->assertNotNull($personneTrouvee);
        $this->assertEquals("david", $personneTrouvee->getPrenom());
    }


    /**
     * stops the kernel
     * @after
     * @return void
     */

    public function closeTests(){
        self::ensureKernelShutdown();
        $this->loadFixtures([AppFixtures::class]);
        
    }
}

