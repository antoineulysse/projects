<?php

namespace App\Tests\Controller;

use App\DataFixtures\AppFixtures;
use App\DataFixtures\EmptyFixtures;
use App\DataFixtures\UserFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityControllerTest extends WebTestCase{

    use FixturesTrait;
    
    private $client;
    /**
     * prepares the test
     * 
     * @return void
     */
    protected function setUp(){
        $this->ensureKernelShutdown();
        $this->client = static::createClient();

    }
      /**
     * This method is called after each test.
     */
    protected function tearDown()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->loadFixtures([EmptyFixtures::class]);
    }
    public function testLoginFormIsDisplayed(){
        $this->client->request("GET", "/connexion");
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains("h1", "Connectez vous");
    }

    public function testLoginSuccessRedirectToPersonsRoute(){
        $this->loadFixtures([UserFixtures::class]);
        $form=$this->createLoginForm("adbk@free.fr","12345678");
        $this->client->submit($form);
       // $this->assertResponseRedirects("/");
        $this->client->followRedirect();
        $this->assertSelectorExists('table');
    }
    /**
     * 
     */
    public function testLoginWithBadEmail(){
        $this->loadFixtures([UserFixtures::class]);
        $form=$this->createLoginForm("aczfczsdbk@free.fr","12345678");
        $this->client->submit($form);
       // $this->assertResponseRedirects("/connexion");
        $this->client->followRedirect();
        $this->assertSelectorExists("form");
  

    }
    private function createLoginForm($email, $password){
        $crawler = $this->client->request("GET", "/connexion");
        $button = $crawler->selectButton('login');
        $form=$button->form([
         "_username"=> $email,
         "_password"=> $password
         ]);
         return $form;
    }
    
}