<?php


namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @Route("/category", name="category_")
 */

class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            [
                'categories' => $categories
            ]
        );
    }

    /**
     * @Route("/{categoryName}", name="show")
     * @return Response A response instance
     */
    public function show($categoryName): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy([
                'name' => $categoryName,
            ]);

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(
                ['category'=> $category], ['id'=>'DESC'], 3
            );

        if (!$programs) {
            throw $this->createNotFoundException(
                'No category "'.$categoryName.'" found in category\'s table.'
            );
        }
//        var_dump($category); die();
        return $this->render(
            'category/show.html.twig',
            [
                'programs' => $programs,
                'category' => $categoryName
            ]
        );
    }
}