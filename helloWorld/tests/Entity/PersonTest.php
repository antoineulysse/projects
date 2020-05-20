<?php

namespace App\Tests\Entity;

use App\Entity\Person;
use App\Controller\PostController;
use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PersonneTest extends KernelTestCase {

    public function testIfPrenomIsValid(){

        self::bootKernel();
        $personne = $this->createPersonne();
        $this->expectXErrorsForPersonne(0, $personne);
    }

    public function testIfPrenomHasLessThan3LettersIsNotValid(){

        self::bootKernel();
        $personne = $this->createPersonne()->setPrenom("de");
        $this->expectXErrorsForPersonne(1, $personne);
    }

    public function testIfNomHasLessThan3LettersIsNotValid(){
        self::bootKernel();
        $personne = $this->createPersonne()->setNom("de");
        $this->expectXErrorsForPersonne(1, $personne);

    }

    public function testHasErrorsNomAndPrenomWithLessThan3Letters(){

        self::bootKernel();
        $personne = $this->createPersonne()->setPrenom("li")->setNom("de");
        $this->expectXErrorsForPersonne(2, $personne);
    }

    private function expectXErrorsForPersonne(int $nbrErrors, Person $person){

        $errors = self::$container->get("validator")->validate($person);
         $this->assertCount($nbrErrors, $errors);
    } 
    private function createPersonne(){

        return (new Person())->setPrenom("David")->setNom("Lisoire");
    }
}