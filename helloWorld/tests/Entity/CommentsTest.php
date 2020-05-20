<?php

namespace App\Tests\Entity;

use App\Entity\Comments;
use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentsTest extends KernelTestCase {

    public function testIfPostIsValid(){
        self::bootKernel();
        $post = $this->createComments();
        $this->expectXErrorsForComments(0, $post);
    }

    public function testHasErrorsCommentsWithLessThan3Letters(){
        self::bootKernel();
        $post = $this->createComments()->setContents("li");
        $this->expectXErrorsForComments(1, $post);
    }

    public function testHasErrorsCommentswithMoreThan255Letters(){
        self::bootKernel();
        $post = $this->createComments()->setContents("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $this->expectXErrorsForComments(1, $post);
    }


    private function expectXErrorsForComments(int $nbrErrors, Comments $comments){
        $errors = self::$container->get("validator")->validate($comments);
        $this->assertCount($nbrErrors, $errors);
    } 
    private function createComments(){
        return (new Comments())->setContents("Lorem Ipsum");
    }

}