<?php

namespace App\Controller\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if (!$this->isGranted("IS_AUTHENTICATED_FULLY")) {
            return $this->render('home/notLogged.html.twig');
        }
        return $this->render('home/logged.html.twig', [
        ]);
    }
}
