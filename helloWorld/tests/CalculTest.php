<?php

use App\Controller\Calcul;
use PHPUnit\Framework\TestCase;

class CalculTest extends TestCase{

    public function testAdditionWithPosititveNumbers(){
        $calcul = new Calcul();
        $result = $calcul->addition(2,8);
        $this-> assertEquals(10, $result);
    }
    public function testAdditionWithNegativeNumbers(){
        $calcul = new Calcul();
        $result = $calcul->addition(-5,-10);

        $this->assertTrue($result == -15);
    }
    public function testAdditionWithNegativeAndPositiveNumbers(){
        $calcul = new Calcul();
        $result = $calcul->addition(5,-10);

        $this->assertTrue($result == -5);
    }
    /*Soustrcation*/

    public function testSoustractionWithPositiveNumbers(){
        $calcul = new Calcul();
        $result = $calcul->soustraction(8,3);
        $this-> assertEquals(5, $result);
    }

    public function testSoustractionWithnegativeNumbers(){
        $calcul = new Calcul();
        $result = $calcul->soustraction(-8,-5);
        $this->assertTrue($result == -3);
    }
    public function testSoustractionWithPositiveAndNegativeNumbers(){

        $calcul= new Calcul();
        $result = $calcul->soustraction(-5,4);
        $this->assertTrue($result == -9);
    }
    /*Multiplication*/

    public function testMultiplicationWithPositiveNumbers(){
        $calcul = new Calcul();
        $result =$calcul->multiplication(8,3);
        $this-> assertEquals(24, $result);

    }
    public function testMultiplicationWithNegativeNumbers(){
        $calcul = new Calcul();
        $result =$calcul->multiplication(-8,-3);
        $this-> assertTrue($result == 24);
    }
    public function testMultiplicationWithPositiveAndNegativeNumbers(){
        $calcul = new Calcul();
        $result =$calcul->multiplication(-8,3);
        $this-> assertTrue($result == -24);
    }
    public function testMultiplicationWithNegativeAndPositiveNumbers(){
        $calcul = new Calcul();
        $result =$calcul->multiplication(8,-3);
        $this-> assertTrue($result == -24);
    }
    /*Division*/

    public function testDivisionWithPositiveNumbers(){
        $calcul = new Calcul();
        $result=$calcul->division(50,10);
        $this->assertTrue($result == 5);

    }
    public function testDivisionWithNegativeNumbers(){
        $calcul = new Calcul();
        $result=$calcul->division(-50,-10);
        $this->assertTrue($result == 5);
    }
    public function testDivisionWithPositiveAndNegativeNumbers(){

        $calcul = new Calcul();
        $result=$calcul->division(4,-2);
        $this->assertTrue($result == -2);
    }
    /**
     * @expectedException InvalidArgumentException
     */

     public function testDivisionByZero(){
         $calcul = new Calcul();
         $result=$calcul->division(1,0);
        
     }


}