<?php

declare(strict_types=1);


namespace App\Controller\Shop\Product;

use App\Entity\ProductQuestion;
use App\Form\ProductQuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductQuestionController extends AbstractController
{
    #[Route('/question/product', name: 'app_product_question')]
    public function __invoke(Request $request)
    {
        $productQuestion = new ProductQuestion();
        $form = $this->createForm(ProductQuestionType::class, $productQuestion)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return new JsonResponse($request->get('test'));
        }
        return new JsonResponse('bad');
    }
}