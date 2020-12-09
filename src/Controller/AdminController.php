<?php


namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use App\Repository\ActorRepository;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('admin/index.html.twig',
        [
                'website' => 'Wild Séries',
        ]);
    }

    /**
     * @Route("/index/series", name="programs")
     * @return Response A response instance
     */
    public function indexPrograms(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'admin/programs.html.twig',
            [
                'website' => 'Wild Séries',
                'programs' => $programs]
        );
    }

    /**
     * @Route("/index/categories", name="categories")
     * @return Response A response instance
     */
    public function indexCategories(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'admin/categories.html.twig',
            [
                'categories' => $categories
            ]
        );
    }

    /**
     * @Route("/index/episodes", name="episodes")
     */
    public function indexEpisodes(EpisodeRepository $episodeRepository): Response
    {
        return $this->render('admin/episodes.html.twig', [
            'episodes' => $episodeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/index/actors", methods={"GET"}, name="actors")
     * @return Response
     */
    public function index(ActorRepository $actorRepository): Response
    {
        return $this->render('admin/actors.html.twig',
            [
                'actors' => $actorRepository->findAll(),
            ]);
    }
}
