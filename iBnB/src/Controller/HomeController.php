<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller {

    /**
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_prenom")
     * montre la page qui dit hello
     * @return void
     */

    public function hello($prenom = "anonyme", $age = 0){
        return $this->render(
            'hello.html.twig',
            [
                'prenom' => $prenom,
                'age' => $age
            ]
            );
    
    }


    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        $prenoms = ["Antoine" =>34 , "Sebastien" => 31, "Matthieu" => 30];

        return $this->render(
            'home.html.twig',
            ['title' => "Bonjour à tous !",
            'age' => 17,
            'tableau' => $prenoms
            ]
        );
    }


}


?>
