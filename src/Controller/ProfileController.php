<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/my-profile", methods={"GET"}, name="profile")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig');
    }
}
