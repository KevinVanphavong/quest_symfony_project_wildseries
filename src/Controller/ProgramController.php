<?php


namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\EpisodeType;
use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProgramController
 * @Route("/programs", name="program_")
 */

Class ProgramController extends AbstractController
{
    /**
     * The controller for the category add form
     * @param Request $request
     * @return Response
     * @Route("/new", name="new")
     */
    public function new(Request $request) : Response
    {
        // Create a new Category Object
        $program = new Program();
        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Render the form
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            $entityManager = $this->getDoctrine()->getManager();
            // Persist Category Object
            $entityManager->persist($program);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('program_index');
        }
        return $this->render('program/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Program $program): Response
    {
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_programs');
        }

        return $this->render('program/edit.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Program $program): Response
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($program);
            $entityManager->flush();
        }

            return $this->redirectToRoute('admin_program');
    }

    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig',
            [
                'website' => 'Wild Séries',
                'programs' => $programs]
        );
    }

    /**
     * @Route("/{id}",requirements={"id"="\d+"},
     *     methods={"GET"},
     *     name="show")
     * @param Program $program
     * @return Response
     */
    public function show(Program $program):Response
    {
//        $program = $this->getDoctrine()
//            ->getRepository(Program::class)
//            ->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$program.' found in program\'s table.'
            );
        }
        $seasons = $program->getSeasons();
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }

    /**
     * @Route("/{program}/seasons/{season}",
     *     requirements={"program"="\d+", "season"="\d+"},
     *     methods={"GET"},
     *     name="season_show")
     *
     * @param Program $program
     * @param Season $season
     *
     * @return Response
     */
    public function showSeason(Program $program, Season $season): Response
    {
//        $program = $this->getDoctrine()
//            ->getRepository(Program::class)
//            ->findOneBy(['id' => $programId]);
//
//        $season = $this->getDoctrine()
//            ->getRepository(Season::class)
//            ->findOneBy(['id' => $seasonId]);

        if (!$season) {
            throw $this->createNotFoundException(
                'No seasons with id : '.$program.' found in season\'s table.'
            );
        }

        $episodes = $season->getEpisodes();

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'episodes' => $episodes,
            'season' => $season,
        ]);
    }

    /**
     * @Route("/{program}/seasons/{season}/episode/{episode}",
     *     requirements={"program"="\d+", "season"="\d+", "episode"="\d+"},
     *     methods={"GET"},
     *     name="episode_show")
     *
     * @param Program $program
     * @param Season $season
     * @param Episode $episode
     *
     * @return Response
     */
    public function showEpisodes(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'episode' => $episode,
            'season' => $season,
        ]);
    }
}
