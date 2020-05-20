<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LikerController extends AbstractController
{
    /**
     * @Route("/liker", name="liker")
     */
    public function index()
    {
        return $this->render('liker/index.html.twig', [
            'controller_name' => 'LikerController',
        ]);
    }
}
