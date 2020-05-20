<?php

namespace App\Tests\Controller;

use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use App\Tests\Controller\Traits\AuthenticateSimulator;
use App\Tests\Controller\traits\AuthenticateSimulatorTrait;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class PersonneControllerTest extends WebTestCase{
    use FixturesTrait;
    use AuthenticateSimulatorTrait;
     private $client;

    /**
     * prepares the test
     * @before
     * @return void 
     */ 
    protected function prepareTest(){
       
        $this ->client = static::createClient();
    }

    public function testRedirectedToLoginWhenNotAuthenticated(){
        $this-> client ->request('GET', '/personnes');

        $this->assertResponseIsSuccessful('login');

    }
    public function testRedirectedToLoginWhenAccessHomePageWithNoAuthentication(){
        $this-> client ->request('GET', '/');

        $this->assertResponseIsSuccessful(Response::HTTP_OK);

    }
    public function testAccessToPersonnesRouteRouteWithAuth(){
        $this->loadFixtures([UserFixtures::class]);
        $user = self::$container->get(UserRepository::class)->find(1);
        // appel de la fonction présente dans AuthenticateSimualtorTrait
        
        $cookie = $this->createCookieForUser($user);
        $this->client->getCookieJar()->set($cookie);
        $this->client->request('GET', '/personnes');
        $this->assertResponseIsSuccessful();

    }
}