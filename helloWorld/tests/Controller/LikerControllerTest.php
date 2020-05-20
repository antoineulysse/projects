<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LikerControllerTest extends WebTestCase{
     private $client;

    /**
     * prepares the test
     * @before
     * @return void 
     */ 
   protected function prepareTest(){
       
        $this ->client = static::createClient();
    }

    public function testRedirectedToWhenNotAuthenticated(){
        $this-> client ->request('GET', '/liker');

        $this->assertResponseIsSuccessful('login');

    }
  
}