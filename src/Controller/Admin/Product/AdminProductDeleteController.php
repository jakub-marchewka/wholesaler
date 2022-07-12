<?php

declare(strict_types=1);


namespace App\Controller\Admin\Product;

use App\Service\Admin\Product\ProductDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductDeleteController extends AbstractController
{
    /**
     * @param Request $request
     * @param ProductDeleteService $deleteService
     * @return JsonResponse
     */
    #[Route('/admin/product/delete', name: 'app_admin_product_delete')]
    public function __invoke(Request $request, ProductDeleteService $deleteService): JsonResponse
    {
        $productId = $request->get('productId');
        if (!$deleteService->delete($productId)) {
            return new JsonResponse('bad');
        }
        return new JsonResponse('good');
    }
}