<?php


namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     * @param ProgramRepository $programRepository
     * @return Response
     */
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findBy([], ['id' => 'DESC'], 5);

        return $this->render('index.html.twig', [
            'website' => 'Wild Séries',
            'programs' => $programs
        ]);
    }

    /**
     * @Route("/test", name="app_test")
     */
    public function test(): Response
    {
        return $this->render('test.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }
}
