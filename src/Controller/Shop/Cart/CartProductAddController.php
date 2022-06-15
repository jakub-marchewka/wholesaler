<?php

declare(strict_types=1);


namespace App\Controller\Shop\Cart;

use App\Entity\Response;
use App\Service\Shop\Cart\CartProductAddService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartProductAddController extends AbstractController
{
    #[Route('/cart/add', name: 'app_cart_add')]
    public function __invoke(Request $request, CartProductAddService $cartProductAddService): JsonResponse
    {
        $productId = $request->get('productId');
        if (empty($productId)) {
            return new JsonResponse(['success' => false, 'message' => 'Product Id does not exsists.']);
        }
        $response = $cartProductAddService->add($productId, $this->getUser());
        return new JsonResponse(['success' => $response->isSuccess(), 'message' => $response->getMessage()]);
    }
}