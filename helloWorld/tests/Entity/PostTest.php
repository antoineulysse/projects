<?php

namespace App\Tests\Entity;

use App\Entity\Post;
use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostTest extends KernelTestCase {

    public function testIfPostIsValid(){
        self::bootKernel();
        $post = $this->createPost();
        $this->expectXErrorsForPost(0, $post);
    }

    public function testHasErrorsPostWithLessThan3Letters(){
        self::bootKernel();
        $post = $this->createPost()->setContent("li");
        $this->expectXErrorsForPost(1, $post);
    }

    public function testHasErrorsPostwithMoreThan255Letters(){
        self::bootKernel();
        $post = $this->createPost()->setContent("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $this->expectXErrorsForPost(1, $post);
    }


    private function expectXErrorsForPost(int $nbrErrors, Post $post){
        $errors = self::$container->get("validator")->validate($post);
        $this->assertCount($nbrErrors, $errors);
    } 
    private function createPost(){
        return (new Post())->setContent("Lorem Ipsum");
    }

}