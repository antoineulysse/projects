<?php

namespace App\Tests\Entity;

use App\Entity\Adresse;
use App\Controller\AdresseController;
use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AdresseTest extends KernelTestCase {

    public function testIfNomRueIsValid(){

        self::bootKernel();
        $adresse = $this->createAdresse();
        $this->expectXErrorsForAdresse(0, $adresse);
    }

    public function testIfNumeroRueHasMoreThan10LettersIsNotValid(){

        self::bootKernel();
        $adresse = $this->createAdresse()->setNumeroRue("012345678912");
        $this->expectXErrorsForAdresse(1, $adresse);
    }

    public function testIfNomRueHasMoreThan255LettersIsNotValid(){
        self::bootKernel();
        $adresse = $this->createAdresse()->setNomRue("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $this->expectXErrorsForAdresse(1, $adresse);

    }

    public function testIfCodePostalHasMoreThan10LettersIsNotValid(){
        self::bootKernel();
        $adresse = $this->createAdresse()->setCodePostal("123456789012");
        $this->expectXErrorsForAdresse(1, $adresse);

    }

    public function testHasErrorsVilleWithmoreThan30Letters(){

        self::bootKernel();
        $adresse = $this->createAdresse()->setVille("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum e");
        $this->expectXErrorsForAdresse(1, $adresse);
    }

    public function testIfPaysHasLessThan3LettersIsNotValid(){
        self::bootKernel();
        $adresse = $this->createAdresse()->setPays("de02015615323116512303123321512
        12312302323");
        $this->expectXErrorsForAdresse(1, $adresse);

    }

    private function expectXErrorsForAdresse(int $nbrErrors, Adresse $Adress){

        $errors = self::$container->get("validator")->validate($Adress);
         $this->assertCount($nbrErrors, $errors);
    } 
    private function createAdresse(){

        return (new Adresse())->setNumeroRue("3")->setNomRue("Lisoire")->setCodePostal("59000")->setVille("Lille")->setPays("France");
    }
}