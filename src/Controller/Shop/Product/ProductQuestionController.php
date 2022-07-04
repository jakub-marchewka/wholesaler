<?php

declare(strict_types=1);


namespace App\Controller\Shop\Product;

use App\Entity\ProductQuestion;
use App\Form\ProductQuestionType;
use App\Service\Shop\Product\ProductQuestionCreateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductQuestionController extends AbstractController
{
    #[Route('/question/product', name: 'app_product_question')]
    public function __invoke(Request $request, ProductQuestionCreateService $productQuestionCreateService)
    {
        $productQuestion = new ProductQuestion();
        $form = $this->createForm(ProductQuestionType::class, $productQuestion)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!empty($request->get('productId'))) {
                if ($productQuestionCreateService->create($productQuestion, $request->get('productId'))) {
                    return new JsonResponse('good');
                }
            }
        }
        return new JsonResponse('bad');
    }
}