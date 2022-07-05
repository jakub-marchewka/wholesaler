<?php

declare(strict_types=1);


namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserIndexController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function __invoke(): Response
    {
        return $this->render('user/index.html.twig');
    }
}