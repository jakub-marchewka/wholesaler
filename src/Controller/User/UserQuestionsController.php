<?php

declare(strict_types=1);


namespace App\Controller\User;

use App\Entity\ProductQuestion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserQuestionsController extends AbstractController
{
    #[Route('/user/questions', name: 'app_user_questions')]
    public function __invoke(EntityManagerInterface $entityManager): Response
    {
        $questions = $entityManager
            ->getRepository(ProductQuestion::class)
            ->findBy(['user' => $this->getUser(), 'answered' => true]);
        return $this->render('user/questions.html.twig', [
            'questions' => $questions
        ]);
    }
}