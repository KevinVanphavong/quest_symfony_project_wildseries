<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }

    /**
     * @Route("/test", name="app_test")
     */
    public function test(): Response
    {
        return $this->render('test.html.twig', [
            'website' => 'Wild Séries',
        ]);    }
}