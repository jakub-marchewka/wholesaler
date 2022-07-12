<?php

declare(strict_types=1);


namespace App\Controller\Admin\ProductQuestion;

use App\Entity\ProductQuestion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductQuestionIndexController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/admin/product/question', name: 'app_admin_product_question_index')]
    public function __invoke(EntityManagerInterface $entityManager): Response
    {
        $productQuestions = $entityManager->getRepository(ProductQuestion::class)->findBy(['answered' => false]);

        return $this->render('admin/question/index.html.twig', [
            'productQuestions' => $productQuestions
        ]);
    }
}